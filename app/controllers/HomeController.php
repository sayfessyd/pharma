<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function showHome()
	{
		return View::make('home');
	}
	public function showMedicaments()
	{
		$medicaments = Medicament::all()->toJson();
		return View::make('medicaments', compact('medicaments'));
	}
	public function showFamilles()
	{
		$familles = Famille::all()->toJson();
		return View::make('familles', compact('familles'));
	}
	public function showNotes()
	{
		$notes = Note::all()->toJson();
		$medicaments = DB::table('med_notes')->get();
		$medicaments = json_encode($medicaments);
		return View::make('notes', compact('notes'), compact('medicaments'));
	}
	public function showCommandes()
	{
		$commandes = Commande::all()->toJson();
		$medicaments = DB::table('med_commandes')->get();
		$medicaments = json_encode($medicaments);
		return View::make('commandes', compact('commandes'), compact('medicaments'));
	}
	public function showMedparfam($id)
	{
		$medicaments = Medicament::where('id_famille', '=', $id)->get()->toJson();
		return View::make('medicaments', compact('medicaments'));
	}
	public function test()
	{
		$medicaments = Medicament::all();
		$list = '';
		foreach ($medicaments as $medicament) {
			if ($medicament['q_stock'] <= $medicament['q_minimum']) 
					$list .= "<li><a href='".url('modifier/medicament')."/".$medicament->id."'> $medicament->code $medicament->nom</a></li>";
		}
		if ($list != '') 
			return "<p><em>Oops... il semble que les quantités de ces medicaments ne satisfont pas le seuil minimum mentionné, veuillez regler ce probleme !</em></p><br><ul>$list</ul><br>";
		else
			return '';
	}
	public function stat($year)
	{
		$query = "SELECT Month(created_at) AS mois, sum(ttc) AS sommes FROM notes 
					WHERE Year(created_at) = ? GROUP BY Month(created_at)";
		$gains = DB::select($query, array($year));
		$query = "SELECT Month(created_at) AS mois, sum(prix) AS sommes FROM commandes 
					WHERE Year(created_at) = ? GROUP BY Month(created_at)";
		$depenses = DB::select($query, array($year));
  		$stat = json_encode(array('gains' => $gains, 'depenses' => $depenses));
  		return $stat;
	}

}
