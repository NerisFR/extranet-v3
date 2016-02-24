<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat_collaborateur extends Model {

	protected $table = 'contrat_collaborateur';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsToMany('User', 'id_collab');
	}

	public function contrat()
	{
		return $this->belongsToMany('Contrat', 'id_contrat');
	}

}