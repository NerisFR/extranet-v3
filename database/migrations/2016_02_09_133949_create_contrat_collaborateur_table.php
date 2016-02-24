<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratCollaborateurTable extends Migration {

	public function up()
	{
		Schema::create('contrat_collaborateur', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_contrat')->unsigned();
			$table->integer('id_collab')->unsigned();
			$table->date('debut');
			$table->date('fin');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contrat_collaborateur');
	}
}