<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('it', function(Blueprint $table)
		{
			$table->bigInteger('id_it', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->string('cdopm', 8);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->date('fato_data');
			$table->date('abertura_data');
			$table->string('vtr_placa', 7);
			$table->string('vtr_prefixo', 10);
			$table->string('vtr_propriedade', 50);
			$table->string('portaria_numero', 12);
			$table->string('boletiminterno_numero', 10);
			$table->date('boletiminterno_data');
			$table->string('tipo_acidente', 50);
			$table->string('avarias', 25);
			$table->string('situacao_objeto', 45);
			$table->text('sintese_txt', 65535);
			$table->string('br_numero', 10);
			$table->string('situacaoviatura', 60);
			$table->string('acordoamigavel', 5);
			$table->bigInteger('id_causa_acidente');
			$table->bigInteger('id_resp_civil');
			$table->string('arquivo_numero', 60);
			$table->string('protocolo_numero', 60);
			$table->string('acaojudicial', 3);
			$table->string('danoestimado_rs', 30);
			$table->string('danoreal_rs', 30);
			$table->string('opm_meta4', 20);
			$table->string('objetoprocedimento', 15)->default('viatura');
			$table->string('identificacao_arma', 40);
			$table->string('identificacao_municao', 45);
			$table->string('identificacao_semovente', 45);
			$table->string('outros', 45);
			$table->string('relatorio_file', 120);
			$table->date('relatorio_data');
			$table->string('solucao_unidade_file', 120);
			$table->date('solucao_unidade_data');
			$table->string('solucao_complementar_file', 120);
			$table->date('solucao_complementar_data');
			$table->integer('prioridade')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('it');
	}

}
