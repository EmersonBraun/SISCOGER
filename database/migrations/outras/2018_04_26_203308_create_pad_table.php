<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pad', function(Blueprint $table)
		{
			$table->integer('id_pad', true);
			$table->integer('id_andamento');
			$table->integer('id_andamentocoger');
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->text('doc_origem_txt', 65535);
			$table->date('fato_data');
			$table->string('cdopm', 12);
			$table->text('sintese_txt', 65535);
			$table->string('portaria_numero', 15);
			$table->date('portaria_data');
			$table->string('doc_tipo', 5);
			$table->string('doc_numero', 12);
			$table->date('abertura_data');
			$table->string('relatorio_file', 100);
			$table->string('solucao_file', 100);
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
		Schema::drop('pad');
	}

}
