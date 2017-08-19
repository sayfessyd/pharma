<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notes', function(Blueprint $table)
		{
			$table->timestamps();
		});
		Schema::table('commandes', function(Blueprint $table)
		{
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notes', function(Blueprint $table)
		{
			$table->dropColumn(array('created_at', 'updated_at'));
		});
		Schema::table('commandes', function(Blueprint $table)
		{
			$table->dropColumn(array('created_at', 'updated_at'));
		});
	}

}
