<?php

class Medicament extends Eloquent
{

	public $timestamps = false;

	protected $fillable = array('code','nom','q_stock','q_minimum','ht','tt','description','autorise');

	protected $with = array('famille');

	public function famille()
	{
		return $this->belongsTo('Famille','id_famille','id')->select(array('id','nom'));
	}

	public function notes()
	{
		return $this->belongsToMany('Note', 'med_notes', 'id_note', 'id_medicament')->withPivot('pu', 'quantite', 'ht', 'tt', 'ttc');
	}

	public function commandes()
	{
		return $this->belongsToMany('Commande', 'med_commandes', 'id_commande', 'id_medicament')->withPivot('quantite');
	}

}