<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('reports', function(Blueprint $table) {
			$table->foreign('id_affect')->references('id')->on('contrat_collaborateur')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('id_dep')->references('id')->on('departements')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('contrats', function(Blueprint $table) {
			$table->foreign('id_client')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('contrat_collaborateur', function(Blueprint $table) {
			$table->foreign('id_contrat')->references('id')->on('contrats')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('contrat_collaborateur', function(Blueprint $table) {
			$table->foreign('id_collab')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('departements', function(Blueprint $table) {
			$table->foreign('id_region')->references('id')->on('regions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('colors_clients_collabs', function(Blueprint $table) {
			$table->foreign('id_collab')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('colors_clients_collabs', function(Blueprint $table) {
			$table->foreign('id_client')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('plannings', function(Blueprint $table) {
			$table->foreign('id_collab')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('plannings', function(Blueprint $table) {
			$table->foreign('id_client')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('reports', function(Blueprint $table) {
			$table->dropForeign('reports_id_affect_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_id_dep_foreign');
		});
		Schema::table('contrats', function(Blueprint $table) {
			$table->dropForeign('contrats_id_client_foreign');
		});
		Schema::table('contrat_collaborateur', function(Blueprint $table) {
			$table->dropForeign('contrat_collaborateur_id_contrat_foreign');
		});
		Schema::table('contrat_collaborateur', function(Blueprint $table) {
			$table->dropForeign('contrat_collaborateur_id_collab_foreign');
		});
		Schema::table('departements', function(Blueprint $table) {
			$table->dropForeign('departements_id_region_foreign');
		});
		Schema::table('colors_clients_collabs', function(Blueprint $table) {
			$table->dropForeign('colors_clients_collabs_id_collab_foreign');
		});
		Schema::table('colors_clients_collabs', function(Blueprint $table) {
			$table->dropForeign('colors_clients_collabs_id_client_foreign');
		});
		Schema::table('plannings', function(Blueprint $table) {
			$table->dropForeign('plannings_id_collab_foreign');
		});
		Schema::table('plannings', function(Blueprint $table) {
			$table->dropForeign('plannings_id_client_foreign');
		});
	}
}