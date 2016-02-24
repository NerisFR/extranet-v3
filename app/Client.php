<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	protected $table = 'clients';
	public $timestamps = true;

	public function departement()
	{
		return $this->belongsTo('Departement', 'id_dep');
	}

}