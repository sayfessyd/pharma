<?php

class Note extends Eloquent
{

	public $timestamps = true;

	protected $fillable = array('ht','tg','ttc');

	public function medicaments()
	{
		return $this->belongsToMany('Medicament', 'med_notes', 'id_note', 'id_medicament')->select(array('id','code'))->withPivot('nom_medicament', 'pu', 'quantite', 'ht', 'tt', 'ttc');
	}

}
