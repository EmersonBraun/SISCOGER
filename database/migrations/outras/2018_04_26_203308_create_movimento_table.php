<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimento', function(Blueprint $table)
		{
			$table->bigInteger('id_movimento', true);
			$table->bigInteger('id_ipm')->default(0)->index('MOV_IPM');
			$table->bigInteger('id_cj')->default(0)->index('MOV_CJ');
			$table->bigInteger('id_cd')->default(0)->index('MOV_CD');
			$table->date('data')->default('0000-00-00');
			$table->text('descricao', 16777215);
			$table->string('rg', 20)->default('');
			$table->string('opm', 20);
			$table->bigInteger('id_adl')->default(0)->index('MOV_ADL');
			$table->bigInteger('id_sindicancia')->default(0)->index('MOV_SINDICANCIA');
			$table->bigInteger('id_fatd')->default(0)->index('MOV_FATD');
			$table->bigInteger('id_desercao')->default(0)->index('MOV_DESERCAO');
			$table->bigInteger('id_iso')->default(0)->index('MOV_ISO');
			$table->bigInteger('id_apfd')->default(0)->index('MOV_APFD');
			$table->bigInteger('id_it')->index('MOV_IT');
			$table->bigInteger('id_pad')->default(0);
			$table->bigInteger('id_sai');
			$table->bigInteger('id_proc_outros');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movimento');
	}

}
