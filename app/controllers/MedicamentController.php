<?php

class MedicamentController extends BaseController
{
	public function ajouter()
	{
		$medicament = array('id'=>'no-id','code'=>'','nom'=>'','q_stock'=>'','q_minimum'=>'','ht'=>'','tt'=>'','autorise'=>'true','description'=>'','famille'=>'');
		$familles = Famille::all();
		return View::make('editer_medicament')->with(compact('medicament'))->with(compact('familles'));
	}

	public function modifier($id)
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$medicament = Medicament::find($id);
			$familles = Famille::all();
			return View::make('editer_medicament')->with(compact('medicament'))->with(compact('familles'));
		}
		return Redirect::to('medicaments');
	}

	public function editer()
	{
		$values = Input::only('id','code','nom','q_stock','q_minimum','ht','tt','autorise','description','famille');
		$rules = array(
			'code' => 'required|unique:medicaments|max:10',
			'nom' => 'required|alpha_num|max:30|min:3',
			'famille' => 'required|exists:familles,id',
			'q_minimum' => 'integer',
			'q_stock' => 'integer|required_with:q_minimum|min:'.$values['q_minimum'],
			'ht' => 'required|numeric|min:0|max:99999',
			'tt' => 'required|numeric|min:0|max:100',
			'autorise' => 'required|boolean',
			'description' => 'max:250'
		);
		if ( is_numeric($values['id']) ) {
			$id = (int)$values['id'];
			$medicament = Medicament::find($id);
			$rules['code'] = 'required|unique:medicaments,code,'.$id.'|max:10';
			$validator = Validator::make($values, $rules);
			if ($validator->fails())
				return Redirect::to('ajouter/medicament')->withErrors($validator)->withInput();
		}
		else
		{
			$medicament = new Medicament;
			$validator = Validator::make($values, $rules);
			if ($validator->fails())
				return Redirect::to('ajouter/medicament')->withErrors($validator)->withInput();
		}
		$medicament->fill($values);
		$famille_id = (int)$values['famille'];
		$famille = Famille::find($famille_id);
		$medicament->famille()->associate($famille);
		$medicament->save();
		return Redirect::to('medicaments');
	}

	public function supprimer($id = array())
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$medicament = Medicament::find($id);
			$medicament->delete();
		}
		elseif ( is_array($id) ) {
			$ids = Input::get('sup');
			if ( is_array($ids) ) {
				DB::table('medicaments')->whereIn('id', $ids)->delete();
			}
		}
		return Redirect::to('medicaments');
	}


}