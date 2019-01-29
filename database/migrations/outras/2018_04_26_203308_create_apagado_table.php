<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApagadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apagado', function(Blueprint $table)
		{
			$table->bigInteger('id_APAGADO', true);
			$table->string('objeto', 200);
			$table->string('rg', 32)->index('IX_RG');
			$table->string('nome', 240);
			$table->string('unidade', 100);
			$table->string('ip', 180);
			$table->dateTime('datahora');
			$table->text('objetoapagado', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apagado');
	}

}
