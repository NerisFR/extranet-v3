<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanningsTable extends Migration {

	public function up()
	{
		Schema::create('plannings', function(Blueprint $table) {
			$table->increments('id');
			$table->datetime('start');
			$table->datetime('end');
			$table->integer('id_collab')->unsigned();
			$table->integer('id_client')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('plannings');
	}
}