<?php

class NoteController extends BaseController
{
	public function ajouter()
	{
		$list = array('id'=>'no-id','codes'=>'','quantites'=>'');
		$medicaments = Medicament::all();
		return View::make('editer_note')->with(compact('list'))->with(compact('medicaments'));
	}

	public function modifier($id)
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$note = Note::find($id);
			$list = array('id' => $note["id"], 'codes' => '', 'quantites' => '');
			foreach ($note->medicaments()->get() as $value) {
				$list['codes'] .= ' '.$value['code'];
				$list['quantites'] .= ' '.$value->pivot['quantite'];
			}
			$list['codes'] = trim($list['codes']);
			$list['quantites'] = trim($list['quantites']);
			$medicaments = Medicament::all();
			return View::make('editer_note')->with(compact('list'))->with(compact('medicaments'));
		}
		return Redirect::to('notes');
	}

	public function editer()
	{
		$values = Input::only('codes','quantites','id');
		$codes = explode(' ', trim($values['codes']));
		$quantites = explode(' ', trim($values['quantites']));
		if ( count($codes) == count($quantites) ) 
			$test = 'yes';
		else
			$test = 'no';
		$rule = array(
			'test' => 'accepted'
		);
		$message = array('accepted' => 'Vous devez indiquer les quantités pour chaque médicament !');
		$check = Validator::make(array('test' => $test), $rule, $message);
		if ( $check->fails() )
			return Redirect::to('ajouter/note')->withErrors($check)->withInput();
		if ( is_numeric($values['id']) ) {
			$process = "modifier";
			$id = (int)$values['id'];
			$note = Note::find($id);
			DB::table('med_notes')->where('id_note', '=', $id)->delete();
		}
		else
		{
			$process = "ajouter";
			$note = new Note;
			$note->save();
			$id = $note->id;
		}
		$note_ht = 0;
		$note_ttc = 0;
		foreach ($codes as $key => $code) {
			$medicament = Medicament::where('code', '=', $code)->first();
			$quantite = (int)$quantites[$key];
			$stock = (int)$medicament['q_stock'];
			if ( $stock >= $quantite ) 
				$compare = "yes";
			else
				$compare = "no";
			$rules = array(
				'code' => 'required|exists:medicaments,code',
				'quantite' => 'required',
				'compare' => 'accepted'
			);
			$messages = array(
				'code.exists' => 'Aucun médicament ne correspond à ce code: '.$code,
				'compare.accepted' => "Vous avez depassé les quantités présentes en stock {$medicament['q_stock']} pour le médicament $code"
			);
			$validator = Validator::make(array('code' => $code, 'quantite' => $quantites[$key], "compare" => $compare), $rules, $messages);
			if ( $validator->fails() )
			{
				if ($process == "ajouter") 
					$note->delete();
				return Redirect::to('ajouter/note')->withErrors($validator)->withInput();
			}
			$ht = ( $medicament['ht'] * $quantites[$key] );
			$ttc = (float) $ht + ($ht*$medicament['tt'])/100 ;
			$note_ht += $ht;
			$note_ttc += $ttc;
			$record = array('id_note' => $id, 'id_medicament' => $medicament['id'], 'quantite' => $quantites[$key],
			 'pu' => $medicament['ht'], 'ht' => $ht, 'tt' => $medicament['tt'], 'ttc' => $ttc,
			 'nom_medicament' => $medicament['nom']);
			DB::table('med_notes')->insert($record);
			$medicament['q_stock'] = $stock-$quantite;
			$medicament->save();
		}
		$note_values = array('ht' => $note_ht, 'ttc' => $note_ttc, 'tg' => (($note_ttc-$note_ht)/$note_ht)*100);
		$note->fill($note_values);
		$note->save();
		return Redirect::to('notes');
	}

	public function supprimer($id = array())
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$note = Note::find($id);
			$note->medicaments()->detach();
			$note->delete();
		}
		elseif ( is_array($id) ) {
			$ids = Input::get('sup');
			if ( is_array($ids) ) {
				DB::table('notes')->whereIn('id', $ids)->delete();
				DB::table('med_notes')->whereIn('id_note', $ids)->delete();
			}
		}
		return Redirect::to('notes');
	}


}
