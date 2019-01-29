<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ipm', function(Blueprint $table)
		{
			$table->bigInteger('id_ipm', true);
			$table->integer('id_andamento')->index('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('id_municipio');
			$table->integer('id_situacao');
			$table->string('cdopm', 10);
			$table->string('opm_sigla', 12)->default('');
			$table->integer('opm_ref')->default(0);
			$table->integer('opm_ref_ano')->default(0);
			$table->bigInteger('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0)->index('IX_ANO');
			$table->date('abertura_data')->nullable();
			$table->date('fato_data')->default('0000-00-00');
			$table->date('autuacao_data')->nullable();
			$table->string('crime', 40)->default('');
			$table->string('tentado', 16);
			$table->string('crime_especificar', 50);
			$table->text('sintese_txt', 65535);
			$table->text('relato_enc', 16777215);
			$table->date('relato_enc_data')->nullable();
			$table->text('relato_cmtopm', 16777215);
			$table->date('relato_cmtopm_data')->nullable();
			$table->text('relato_cmtgeral', 16777215);
			$table->date('relato_cmtgeral_data')->nullable();
			$table->string('vajme_ref', 40)->default('');
			$table->string('justicacomum_ref', 150);
			$table->string('vitima', 20)->default('');
			$table->char('confronto_armado_bl', 1)->default('');
			$table->smallInteger('vitima_qtdd')->default(0);
			$table->string('julgamento', 15)->default('');
			$table->string('portaria_numero', 12);
			$table->text('exclusao_txt', 16777215);
			$table->string('relato_enc_file', 100);
			$table->string('relato_cmtopm_file', 100);
			$table->string('relato_cmtgeral_file', 100);
			$table->string('defensor_oab', 20);
			$table->string('defensor_nome', 80);
			$table->string('relcomplementar_file', 180);
			$table->date('relcomplementar_data');
			$table->string('opm_meta4', 20);
			$table->integer('bou_ano');
			$table->integer('bou_numero');
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
		Schema::drop('ipm');
	}

}
