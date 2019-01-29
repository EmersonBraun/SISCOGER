<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcOutrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proc_outros', function(Blueprint $table)
		{
			$table->bigInteger('id_proc_outros', true);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->string('rg_cadastro', 25);
			$table->string('cdopm', 12);
			$table->string('opm_abreviatura', 36);
			$table->string('cdopm_apuracao', 12);
			$table->date('abertura_data')->default('0000-00-00');
			$table->date('data')->default('0000-00-00');
			$table->string('bou_ano', 20);
			$table->string('bou_numero', 30);
			$table->integer('id_municipio')->default(82362);
			$table->string('doc_origem', 120);
			$table->string('num_doc_origem', 120);
			$table->string('motivo_abertura', 30);
			$table->text('sintese_txt', 65535);
			$table->string('relatorio1', 45);
			$table->string('relatorio1_file', 120);
			$table->date('relatorio1_data')->default('0000-00-00');
			$table->string('relatorio2', 45);
			$table->string('relatorio2_file', 120);
			$table->date('relatorio2_data')->default('0000-00-00');
			$table->string('relatorio3', 45);
			$table->string('relatorio3_file', 120);
			$table->date('relatorio3_data')->default('0000-00-00');
			$table->string('desc_outros', 45);
			$table->string('andamento', 50);
			$table->string('andamentocoger', 50);
			$table->string('vtr1_placa', 45);
			$table->string('vtr1_prefixo', 45);
			$table->string('vtr2_placa', 45);
			$table->string('vtr2_prefixo', 45);
			$table->string('digitador', 100);
			$table->string('num_pid', 45);
			$table->date('limite_data');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proc_outros');
	}

}
