<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomMedicament extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('med_notes', function(Blueprint $table)
		{
			$table->string('nom_medicament', 128);
		});
		Schema::table('med_commandes', function(Blueprint $table)
		{
			$table->string('nom_medicament', 128);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('med_notes', function(Blueprint $table)
		{
			$table->dropColumn(array('nom_medicament'));
		});
		Schema::table('med_commandes', function(Blueprint $table)
		{
			$table->dropColumn(array('nom_medicament'));
		});
	}

}
