<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorsClientsCollabsTable extends Migration {

	public function up()
	{
		Schema::create('colors_clients_collabs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_collab')->unsigned();
			$table->integer('id_client')->unsigned();
			$table->string('ref_color');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('colors_clients_collabs');
	}
}