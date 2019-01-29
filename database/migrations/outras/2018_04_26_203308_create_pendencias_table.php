<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pendencias', function(Blueprint $table)
		{
			$table->string('cdopm', 12)->primary();
			$table->integer('comportamento');
			$table->integer('fatd_punicao');
			$table->integer('fatd_prazo');
			$table->integer('fatd_abertura');
			$table->integer('ipm_prazo');
			$table->integer('ipm_abertura');
			$table->integer('sindicancia_prazo');
			$table->integer('sindicancia_abertura');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pendencias');
	}

}
