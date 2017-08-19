<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NoForeign extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('med_notes', function(Blueprint $table)
		{
			$table->dropForeign('med_notes_id_note_foreign');
			$table->dropForeign('med_notes_id_medicament_foreign');
		});
		Schema::table('med_commandes', function(Blueprint $table)
		{
			$table->dropForeign('med_commandes_id_commande_foreign');
			$table->dropForeign('med_commandes_id_medicament_foreign');
		});
		

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	
	}

}
