<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('nom');
			$table->text('cp');
			$table->text('adresse');
			$table->text('ville');
			$table->integer('id_dep')->unsigned();
			$table->text('SIRET');
			$table->text('tel');
			$table->string('web');
			$table->string('mail');
			$table->string('fax');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}