<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIsoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iso', function(Blueprint $table)
		{
			$table->bigInteger('id_iso', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0);
			$table->string('cdopm', 8)->default('');
			$table->date('fato_data')->default('0000-00-00');
			$table->date('abertura_data')->default('0000-00-00');
			$table->text('sintese_txt', 65535);
			$table->string('tipo_penal', 60)->default('');
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 10)->default('');
			$table->string('portaria_numero', 12)->default('');
			$table->date('portaria_data')->default('0000-00-00');
			$table->text('exclusao_txt', 16777215);
			$table->string('opm_meta4', 20);
			$table->string('relatoriomedico_file', 120)->default('');
			$table->date('relatoriomedico_data')->default('0000-00-00');
			$table->string('solucaoautoridade_file', 120)->default('');
			$table->date('solucaoautoridade_data')->default('0000-00-00');
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
		Schema::drop('iso');
	}

}
