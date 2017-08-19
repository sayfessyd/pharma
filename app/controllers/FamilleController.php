<?php

class FamilleController extends BaseController
{
	public function ajouter()
	{
		$famille = array('id'=>'no-id','code'=>'','nom'=>'','description'=>'');
		return View::make('editer_famille', compact('famille'));
	}

	public function modifier($id)
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$famille = Famille::find($id);
			return View::make('editer_famille', compact('famille'));
		}
		return Redirect::to('familles');
	}

	public function editer()
	{
		$values = Input::only('id','code','nom','description');
		if ( is_numeric($values['id']) ) {
			$id = (int)$values['id'];
			$famille = Famille::find($id);
			$rules = array(
				'code' => 'required|unique:familles,code,'.$id.'|max:10',
				'nom' => 'required|alpha_num|max:30|min:3',
				'description' => 'max:250'
			);
			$validator = Validator::make($values, $rules);
			if ($validator->fails())
				return Redirect::to('ajouter/famille')->withErrors($validator)->withInput();
		}
		else
		{
			$famille = new Famille;
			$rules = array(
				'code' => 'required|unique:familles|max:10',
				'nom' => 'required|alpha_num|max:30|min:3',
				'description' => 'max:250'
			);
			$validator = Validator::make($values, $rules);
			if ($validator->fails())
				return Redirect::to('ajouter/famille')->withErrors($validator)->withInput();
		}
		$famille->fill($values);
		$famille->save();
		return Redirect::to('familles');
	}

	public function supprimer($id = array())
	{
		if ( is_numeric($id) ) {
			$id = (int)$id;
			$famille = Famille::find($id);
			$famille->medicaments()->delete();
			$famille->delete();
		}
		elseif ( is_array($id) ) {
			$ids = Input::get('sup');
			if ( is_array($ids) ) {
				DB::table('medicaments')->whereIn('id_famille', $ids)->delete();
				DB::table('familles')->whereIn('id', $ids)->delete();
			}
		}
		return Redirect::to('familles');
	}


}