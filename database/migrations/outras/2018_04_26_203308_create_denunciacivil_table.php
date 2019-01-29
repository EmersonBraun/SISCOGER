<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDenunciacivilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('denunciacivil', function(Blueprint $table)
		{
			$table->bigInteger('id_denunciacivil', true);
			$table->string('rg', 20);
			$table->string('rg_cadastro', 20);
			$table->string('cargo', 12);
			$table->string('nome', 120);
			$table->string('processo', 200);
			$table->string('infracao', 200);
			$table->string('processocrime', 12);
			$table->string('julgamento', 12);
			$table->string('tipodapena', 20);
			$table->integer('pena_anos');
			$table->integer('pena_meses');
			$table->integer('pena_dias');
			$table->string('transitojulgado_bl', 1);
			$table->string('restritiva_bl', 1);
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
		Schema::drop('denunciacivil');
	}

}
