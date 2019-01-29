<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesercaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('desercao', function(Blueprint $table)
		{
			$table->bigInteger('id_desercao', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref')->default(0);
			$table->integer('sjd_ref_ano')->default(0);
			$table->string('cdopm', 8)->default('');
			$table->date('fato_data')->default('0000-00-00');
			$table->string('doc_tipo', 5)->default('');
			$table->string('doc_numero', 10)->default('');
			$table->string('termo_exclusao', 60);
			$table->string('termo_exclusao_pub', 60);
			$table->string('termo_captura', 60);
			$table->string('termo_captura_pub', 60);
			$table->string('pericia', 60);
			$table->string('pericia_pub', 60);
			$table->string('termo_inclusao', 60);
			$table->string('termo_inclusao_pub', 60);
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
		Schema::drop('desercao');
	}

}
