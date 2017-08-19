<?php

class Commande extends Eloquent
{

	public $timestamps = true;

	protected $fillable = array('reception','prix','fournisseur');
	
	public function medicaments()
	{
		return $this->belongsToMany('Medicament', 'med_commandes', 'id_commande', 'id_medicament')->select(array('id','code'))->withPivot('nom_medicament', 'quantite');
	}

}