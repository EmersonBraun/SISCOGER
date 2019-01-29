<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSobrestamentoBkpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sobrestamento_bkp', function(Blueprint $table)
		{
			$table->bigInteger('id_sobrestamento')->default(0);
			$table->string('rg', 20);
			$table->date('inicio_data');
			$table->string('publicacao_inicio', 100);
			$table->date('termino_data');
			$table->string('publicacao_termino', 100);
			$table->string('motivo', 100);
			$table->bigInteger('id_cj');
			$table->bigInteger('id_cd');
			$table->bigInteger('id_sindicancia');
			$table->bigInteger('id_fatd');
			$table->bigInteger('id_iso');
			$table->bigInteger('id_it');
			$table->bigInteger('id_adl');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sobrestamento_bkp');
	}

}
