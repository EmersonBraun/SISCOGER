<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaidiligenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saidiligencias', function(Blueprint $table)
		{
			$table->bigInteger('id_saidiligencias', true);
			$table->bigInteger('sai');
			$table->string('rg_cadastro', 24);
			$table->date('data');
			$table->string('cdopm', 12);
			$table->string('opm_abreviatura', 36);
			$table->text('diligencias_txt', 65535)->index('TEXTO');
			$table->string('digitador', 120);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('saidiligencias');
	}

}
