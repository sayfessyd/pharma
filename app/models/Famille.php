<?php

class Famille extends Eloquent
{

	public $timestamps = false;

	protected $fillable = array('code','nom','description');

	public function medicaments()
	{
		return $this->hasMany('Medicament','id_famille');
	}

}