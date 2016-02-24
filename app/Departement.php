<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model {

	protected $table = 'departements';
	public $timestamps = true;

	public function region()
	{
		return $this->belongsTo('Region', 'id_region');
	}

}