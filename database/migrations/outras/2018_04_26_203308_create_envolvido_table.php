<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnvolvidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('envolvido', function(Blueprint $table)
		{
			$table->bigInteger('id_envolvido', true);
			$table->string('rg_substituto', 20)->default('');
			$table->string('nome', 80)->default('')->index('nome');
			$table->string('rg', 20)->default('')->index('IX_RG');
			$table->string('situacao', 15)->index('IX_SITUACAO');
			$table->string('cargo', 20)->default('');
			$table->string('resultado', 40)->index('IX_RESULTADO');
			$table->integer('inclusao_ano');
			$table->bigInteger('id_ipm')->default(0)->index('IX_IPM');
			$table->bigInteger('id_cj')->nullable()->index('IX_CJ');
			$table->bigInteger('id_cd')->default(0)->index('IX_CD');
			$table->bigInteger('id_adl')->default(0)->index('IX_ADL');
			$table->bigInteger('id_sindicancia')->default(0)->index('IX_SINDICANCIA');
			$table->bigInteger('id_fatd')->default(0)->index('IX_FATD');
			$table->bigInteger('id_desercao')->default(0)->index('IX_DESERCAO');
			$table->bigInteger('id_apfd')->default(0)->index('IX_APFD');
			$table->bigInteger('id_iso')->default(0)->index('IX_ISO');
			$table->bigInteger('id_it')->index('IX_IT');
			$table->integer('id_pad');
			$table->bigInteger('id_sai');
			$table->string('ipm_julgamento', 12);
			$table->string('ipm_processocrime', 15);
			$table->integer('ipm_pena_anos');
			$table->integer('ipm_pena_meses');
			$table->integer('ipm_pena_dias');
			$table->string('ipm_tipodapena', 12);
			$table->string('ipm_transitojulgado_bl', 1);
			$table->string('ipm_restritiva_bl', 1);
			$table->text('obs_txt', 65535);
			$table->date('exclusaoportaria_data');
			$table->string('exclusaoportaria_numero', 10);
			$table->string('exclusaoboletim', 2);
			$table->integer('exclusaobg_numero');
			$table->integer('exclusaobg_ano');
			$table->date('exclusaobg_data');
			$table->string('exclusaoopm', 60);
			$table->bigInteger('id_punicao')->index('PUNICAO');
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
		Schema::drop('envolvido');
	}

}
