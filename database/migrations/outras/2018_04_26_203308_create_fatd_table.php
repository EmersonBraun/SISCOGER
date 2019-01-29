<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFatdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fatd', function(Blueprint $table)
		{
			$table->bigInteger('id_fatd', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref')->default(0)->index('FATDREF');
			$table->integer('sjd_ref_ano')->default(0)->index('FATDANO');
			$table->date('fato_data')->default('0000-00-00');
			$table->date('abertura_data')->default('0000-00-00');
			$table->text('sintese_txt', 65535);
			$table->string('cdopm', 8)->default('');
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 10)->default('');
			$table->text('doc_origem_txt', 65535);
			$table->string('despacho_numero', 12)->default('');
			$table->date('portaria_data')->default('0000-00-00');
			$table->string('fato_file', 60)->default('');
			$table->string('relatorio_file', 60)->default('');
			$table->string('sol_cmt_file', 80);
			$table->string('sol_cg_file', 80);
			$table->string('rec_ato_file', 120);
			$table->string('rec_cmt_file', 120);
			$table->string('rec_crpm_file', 120);
			$table->string('rec_cg_file', 120);
			$table->string('opm_meta4', 20);
			$table->string('notapunicao_file', 180);
			$table->string('publicacaonp', 80);
			$table->integer('prioridade')->default(0);
			$table->string('situacao_fatd', 80);
			$table->string('motivo_fatd', 80);
			$table->string('motivo_outros', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fatd');
	}

}
