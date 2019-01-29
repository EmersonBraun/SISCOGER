<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfendidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofendido', function(Blueprint $table)
		{
			$table->bigInteger('id_ofendido', true);
			$table->string('nome', 80)->default('')->index('nome');
			$table->string('rg', 20)->default('');
			$table->string('situacao', 15)->default('');
			$table->string('resultado', 32)->index('IX_RESULTADO');
			$table->string('sexo', 1);
			$table->string('idade', 20);
			$table->string('escolaridade', 50)->index('IX_ESCOLA');
			$table->bigInteger('id_ipm')->default(0)->index('IX_IPM');
			$table->bigInteger('id_cj')->default(0);
			$table->bigInteger('id_cd')->default(0);
			$table->bigInteger('id_adl')->default(0);
			$table->bigInteger('id_sindicancia')->default(0)->index('IX_SINDICANCIA');
			$table->bigInteger('id_fatd')->default(0)->index('IX_FATD');
			$table->bigInteger('id_desercao');
			$table->bigInteger('id_apfd')->default(0);
			$table->bigInteger('id_iso')->default(0);
			$table->bigInteger('id_it');
			$table->integer('id_pad');
			$table->bigInteger('id_sai');
			$table->bigInteger('id_proc_outros');
			$table->string('fone', 20);
			$table->string('email', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ofendido');
	}

}
