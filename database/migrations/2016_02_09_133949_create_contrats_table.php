<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratsTable extends Migration {

	public function up()
	{
		Schema::create('contrats', function(Blueprint $table) {
			$table->increments('id');
			$table->softDeletes();
			$table->text('numero');
			$table->date('signature');
			$table->integer('duree');
			$table->integer('demarrage');
			$table->date('date_fin_mission');
			$table->tinyInteger('marche');
			$table->integer('preavis');
			$table->tinyInteger('reconduction');
			$table->integer('volume');
			$table->integer('base_sem');
			$table->integer('nb_mois');
			$table->integer('rythmicite');
			$table->text('description');
			$table->integer('id_client')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contrats');
	}
}