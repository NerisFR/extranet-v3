<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration {

	public function up()
	{
		Schema::create('reports', function(Blueprint $table) {
			$table->increments('id');
			$table->date('jour');
			$table->text('arrivee');
			$table->text('depart');
			$table->text('type_heure');
			$table->decimal('tps_total');
			$table->decimal('tps_adm');
			$table->decimal('tps_maint');
			$table->decimal('tps_parc');
			$table->decimal('tps_prix');
			$table->decimal('tps_inst');
			$table->decimal('tps_assist');
			$table->decimal('tps_form');
			$table->decimal('tps_proj');
			$table->decimal('tps_dev');
			$table->decimal('tps_reunion');
			$table->decimal('tps_dep');
			$table->decimal('tps_ctrl');
			$table->decimal('tps_autre');
			$table->enum('ctrl_log', array('true', ''));
			$table->enum('ctrl_hdd', array('true', ''));
			$table->enum('ctrl_raid', array('true', ''));
			$table->enum('ctrl_maj_os', array('true', ''));
			$table->enum('ctrl_maj_hard', array('true', ''));
			$table->enum('ctrl_maj_soft', array('true', ''));
			$table->enum('ctrl_backup', array('true', ''));
			$table->enum('volum_backup', array('true', ''));
			$table->enum('maj_backup', array('true', ''));
			$table->enum('ctrl_antivirus', array('true', ''));
			$table->enum('maj_antivirus', array('true', ''));
			$table->text('commentaire');
			$table->integer('id_affect')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reports');
	}
}