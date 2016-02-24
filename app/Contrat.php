<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrat extends Model {

	protected $table = 'contrats';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function client()
	{
		return $this->belongsTo('Client', 'id_client');
	}

}