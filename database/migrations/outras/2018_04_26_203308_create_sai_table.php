<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sai', function(Blueprint $table)
		{
			$table->bigInteger('id_sai', true);
			$table->string('rg', 24)->index('IX_RG');
			$table->string('cargo', 12);
			$table->string('nome', 120);
			$table->string('rg_cadastro', 24);
			$table->date('data');
			$table->string('docorigem', 250);
			$table->string('cdopm', 12);
			$table->string('cdopm_fato', 12);
			$table->string('cdopm_controle', 12);
			$table->string('opm_abreviatura', 36);
			$table->text('sintese_txt', 65535)->index('BUSCA_SAI');
			$table->string('digitador', 120);
			$table->string('arquivopasta', 250);
			$table->string('bou_ano1', 20);
			$table->string('bou_numero1', 30);
			$table->integer('id_municipio');
			$table->string('bairro', 50);
			$table->string('logradouro', 150);
			$table->string('numerodoc', 30);
			$table->string('motivo_principal', 45);
			$table->string('motivo_secundario', 45);
			$table->string('desc_outros', 100);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref');
			$table->date('abertura_data')->default('0000-00-00');
			$table->integer('sjd_ref_ano');
			$table->string('vtr1_placa', 7);
			$table->string('vtr1_prefixo', 10);
			$table->string('vtr2_placa', 7);
			$table->string('vtr2_prefixo', 10);
			$table->string('relatorio1', 45);
			$table->date('relatorio1_data')->default('0000-00-00');
			$table->string('relatorio1_file', 120);
			$table->string('relatorio2', 45);
			$table->date('relatorio2_data')->default('0000-00-00');
			$table->string('relatorio2_file', 120);
			$table->string('relatorio3', 45);
			$table->date('relatorio3_data')->default('0000-00-00');
			$table->string('relatorio3_file', 120);
			$table->string('bou_ano2', 20);
			$table->string('bou_ano3', 20);
			$table->string('bou_numero2', 45);
			$table->string('bou_numero3', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sai');
	}

}
