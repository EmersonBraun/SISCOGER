<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuspensoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suspenso', function(Blueprint $table)
		{
			$table->bigInteger('id_suspenso', true);
			$table->string('rg', 32);
			$table->string('cargo', 12);
			$table->string('nome', 120);
			$table->string('processo');
			$table->string('infracao');
			$table->string('numerounico', 32);
			$table->date('inicio_data');
			$table->date('fim_data');
			$table->text('obs_txt', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('suspenso');
	}

}
