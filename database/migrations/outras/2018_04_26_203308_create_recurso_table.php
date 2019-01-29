<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecursoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recurso', function(Blueprint $table)
		{
			$table->bigInteger('id_recurso', true);
			$table->string('cdopm', 12);
			$table->string('opm', 120);
			$table->string('rg', 32);
			$table->string('nome', 180);
			$table->string('procedimento', 20);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->dateTime('datahora');
			$table->bigInteger('id_movimento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recurso');
	}

}
