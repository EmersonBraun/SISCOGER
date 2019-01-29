<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermocompromissoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('termocompromisso', function(Blueprint $table)
		{
			$table->string('rg', 15);
			$table->string('ip', 24);
			$table->dateTime('datahora');
			$table->string('concorda_bl', 1);
			$table->string('nome', 90);
			$table->string('email', 60);
			$table->string('telefone', 40);
			$table->string('UserExpresso', 90);
			$table->string('celular', 20);
			$table->string('opm', 24);
			$table->primary(['rg','concorda_bl']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('termocompromisso');
	}

}
