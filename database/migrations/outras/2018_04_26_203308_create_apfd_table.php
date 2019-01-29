<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApfdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apfd', function(Blueprint $table)
		{
			$table->bigInteger('id_apfd', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0);
			$table->string('tipo', 20)->default('');
			$table->string('cdopm', 10)->index('IX_OPMAPFD');
			$table->date('fato_data')->default('0000-00-00');
			$table->text('sintese_txt', 65535);
			$table->string('tipo_penal', 60)->default('');
			$table->string('tipo_penal_novo', 85);
			$table->string('especificar', 160);
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 12)->default('');
			$table->text('exclusao_txt', 16777215);
			$table->string('opm_meta4', 20);
			$table->string('referenciavajme', 150);
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
		Schema::drop('apfd');
	}

}
