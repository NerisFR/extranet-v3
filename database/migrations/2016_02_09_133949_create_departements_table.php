<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartementsTable extends Migration {

	public function up()
	{
		Schema::create('departements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('num');
			$table->string('nom');
			$table->integer('id_region')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('departements');
	}
}