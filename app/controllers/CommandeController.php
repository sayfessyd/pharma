<?php

class CommandeController extends BaseController
{
	public function ajouter()
	{
		$list = array('id'=>'no-id','codes'=>'','quantites'=>'','fournisseur' => '', 'reception' => false, 'prix' => 0);
		$medicaments = Medicament::all();
		return View::make('editer_commande')->with(compact('list'))->with(compact('medicaments'));
	}

	public function modifier($id)
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$commande = Commande::find($id);
			$list = array('id' => $commande["id"], 'codes' => '', 'quantites' => '', 'fournisseur' => $commande["fournisseur"], 'reception' => $commande["reception"], 'prix' => $commande['prix']);
			foreach ($commande->medicaments()->get() as $value) {
				$list['codes'] .= ' '.$value['code'];
				$list['quantites'] .= ' '.$value->pivot['quantite'];
			}
			$list['codes'] = trim($list['codes']);
			$list['quantites'] = trim($list['quantites']);
			$medicaments = Medicament::all();
			return View::make('editer_commande')->with(compact('list'))->with(compact('medicaments'));
		}
		return Redirect::to('commandes');
	}

	public function editer()
	{
		$values = Input::only('codes','quantites','fournisseur','id','recu','prix');
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
			return Redirect::to('ajouter/commande')->withErrors($check)->withInput();
		if ( is_numeric($values['id']) ) {
			$process = "modifier";
			$id = (int)$values['id'];
			$commande = Commande::find($id);
			DB::table('med_commandes')->where('id_commande', '=', $id)->delete();
		}
		else
		{
			$process = "ajouter";
			$commande = new Commande;
			$commande->save();
			$id = $commande->id;
		}
		foreach ($codes as $key => $code) {
			$medicament = Medicament::where('code', '=', $code)->first();
			$rules = array(
				'code' => 'required',
				'quantite' => 'required',
			);
			$validator = Validator::make(array('code' => $code, 'quantite' => $quantites[$key]), $rules);
			if ( $validator->fails() )
			{
				if ($process == "ajouter") 
					$commande->delete();
				return Redirect::to('ajouter/commande')->withErrors($validator)->withInput();
			}
			$record = array('id_commande' => $id, 'id_medicament' => $medicament['id'], 'quantite' => $quantites[$key], 'nom_medicament' => $medicament['nom']);
			DB::table('med_commandes')->insert($record);
			if ($values['recu'] == 'oui') {
				$medicament['q_stock'] = (int)$medicament['q_stock'] + (int)$quantites[$key];
				$medicament->save();
			}
		}
		$commande['fournisseur'] = $values['fournisseur'];
		if ($values['recu'] == 'oui')
		{
			$commande['reception'] = true;
			$commande['prix'] = $values['prix'];
		}
		$commande->save();
		return Redirect::to('commandes');
	}

	public function supprimer($id = array())
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$commande = Commande::find($id);
			$commande->medicaments()->detach();
			$commande->delete();
		}
		elseif ( is_array($id) ) {
			$ids = Input::get('sup');
			if ( is_array($ids) ) {
				DB::table('commandes')->whereIn('id', $ids)->delete();
				DB::table('med_commandes')->whereIn('id_commande', $ids)->delete();
			}
		}
		return Redirect::to('commandes');
	}


}
