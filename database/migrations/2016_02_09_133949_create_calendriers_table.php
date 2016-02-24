<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalendriersTable extends Migration {

	public function up()
	{
		Schema::create('calendriers', function(Blueprint $table) {
			$table->increments('id');
			$table->date('jour');
		});
	}

	public function down()
	{
		Schema::drop('calendriers');
	}
}