<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSindicanciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sindicancia', function(Blueprint $table)
		{
			$table->bigInteger('id_sindicancia', true);
			$table->integer('id_andamentocoger');
			$table->integer('id_andamento');
			$table->integer('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0);
			$table->date('fato_data')->nullable();
			$table->date('abertura_data')->default('0000-00-00');
			$table->text('sintese_txt', 65535);
			$table->string('cdopm', 8)->default('');
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 10)->default('');
			$table->text('doc_origem_txt', 65535);
			$table->string('portaria_numero', 10)->default('');
			$table->date('portaria_data')->default('0000-00-00');
			$table->string('sol_cmt_file', 80)->default('');
			$table->date('sol_cmt_data');
			$table->string('sol_cmtgeral_file', 120);
			$table->date('sol_cmtgeral_data');
			$table->string('opm_meta4', 20);
			$table->string('relatorio_file', 120)->default('');
			$table->date('relatorio_data')->default('0000-00-00');
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
		Schema::drop('sindicancia');
	}

}
