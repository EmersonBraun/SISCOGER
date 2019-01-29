<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adl', function(Blueprint $table)
		{
			$table->bigInteger('id_adl', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('id_motivoconselho');
			$table->boolean('id_decorrenciaconselho');
			$table->integer('id_situacaoconselho')->nullable();
			$table->string('outromotivo', 100);
			$table->string('cdopm', 12);
			$table->date('fato_data')->default('0000-00-00');
			$table->date('abertura_data')->default('0000-00-00');
			$table->text('sintese_txt', 65535);
			$table->string('libelo_file', 80)->default('');
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 12)->default('');
			$table->string('portaria_numero', 9)->default('');
			$table->date('portaria_data')->default('0000-00-00');
			$table->string('parecer_file', 80)->default('');
			$table->string('decisao_file', 80)->default('');
			$table->string('doc_prorrogacao', 30)->default('');
			$table->integer('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0);
			$table->date('prescricao_data');
			$table->string('parecer_comissao', 30);
			$table->string('parecer_cmtgeral', 30);
			$table->text('exclusao_txt', 16777215);
			$table->string('rec_ato_file', 120);
			$table->string('rec_gov_file', 120);
			$table->string('ac_desempenho_bl', 1)->comment('Lei 16544 Art 5 II A');
			$table->string('ac_conduta_bl', 1)->comment('Lei 16544 Art 5 II B');
			$table->string('ac_honra_bl', 1)->comment('Lei 16544 Art 5 II C');
			$table->string('tjpr_file', 254)->nullable();
			$table->string('stj_file', 254)->nullable();
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
		Schema::drop('adl');
	}

}
