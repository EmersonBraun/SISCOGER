<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogAcessosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('log_acessos', function(Blueprint $table)
		{
			$table->bigInteger('id_log_acessos', true);
			$table->bigInteger('rg');
			$table->dateTime('datahora');
			$table->string('ip', 25);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('log_acessos');
	}

}
