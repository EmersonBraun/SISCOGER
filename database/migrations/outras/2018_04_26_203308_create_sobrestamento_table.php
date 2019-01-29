<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSobrestamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sobrestamento', function(Blueprint $table)
		{
			$table->bigInteger('id_sobrestamento', true);
			$table->string('rg', 20);
			$table->date('inicio_data');
			$table->string('publicacao_inicio', 100);
			$table->date('termino_data');
			$table->string('publicacao_termino', 100);
			$table->string('motivo', 100);
			$table->bigInteger('id_cj')->index('SOB_CJ');
			$table->bigInteger('id_cd')->index('SOB_CD');
			$table->bigInteger('id_sindicancia')->index('SOB_SINDICANCIA');
			$table->bigInteger('id_fatd')->index('SOB_FATD');
			$table->bigInteger('id_iso')->index('SOB_ISO');
			$table->bigInteger('id_it')->index('SOB_IT');
			$table->bigInteger('id_adl')->index('SOB_ADL');
			$table->bigInteger('id_pad')->default(0);
			$table->bigInteger('id_sai');
			$table->bigInteger('id_proc_outros');
			$table->string('doc_controle_inicio', 50);
			$table->string('doc_controle_termino', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sobrestamento');
	}

}
