<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color_client_collab extends Model {

	protected $table = 'colors_clients_collabs';
	public $timestamps = true;
	protected $fillable = array('ref_color');

}