<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('familles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 10)->unique();
			$table->string('nom', 128);
			$table->text('description');
		});
		Schema::create('medicaments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_famille')->unsigned();
			$table->foreign('id_famille')->references('id')->on('familles');
			$table->string('code', 10)->unique();
			$table->string('nom', 128);
			$table->integer('q_stock');
			$table->integer('q_minimum');
			$table->decimal('ht');
			$table->decimal('tt');
			$table->text('description');
			$table->boolean('autorise');
		});
		Schema::create('notes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('ht');
			$table->decimal('tg');
			$table->decimal('ttc');
		});
		Schema::create('commandes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fournisseur', 128);
			$table->boolean('reception');
			$table->decimal('prix');

		});
		Schema::create('med_notes', function(Blueprint $table)
		{
			$table->integer('id_note')->unsigned();
			$table->foreign('id_note')->references('id')->on('notes');
			$table->integer('id_medicament')->unsigned();
			$table->foreign('id_medicament')->references('id')->on('medicaments');
			$table->integer('quantite');
			$table->decimal('pu');
			$table->decimal('ht');
			$table->decimal('tt');
			$table->decimal('ttc');
		});
		Schema::create('med_commandes', function(Blueprint $table)
		{
			$table->integer('id_medicament')->unsigned();
			$table->foreign('id_medicament')->references('id')->on('medicaments');
			$table->integer('id_commande')->unsigned();
			$table->foreign('id_commande')->references('id')->on('commandes');
			$table->integer('quantite');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('med_commandes');
		Schema::drop('med_notes');
		Schema::drop('commandes');
		Schema::drop('notes');
		Schema::drop('medicaments');
		Schema::drop('familles');
	}

}
