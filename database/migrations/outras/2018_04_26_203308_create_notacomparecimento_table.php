<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotacomparecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notacomparecimento', function(Blueprint $table)
		{
			$table->bigInteger('id_notacomparecimento', true);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->date('expedicao_data')->nullable();
			$table->bigInteger('id_tiponotacomparecimento')->nullable();
			$table->text('observacao_txt', 65535)->nullable();
			$table->string('autoridade_rg', 20)->nullable();
			$table->string('autoridade_cargo', 80)->nullable();
			$table->string('autoridade_quadro', 80)->nullable();
			$table->string('autoridade_nome', 160)->nullable();
			$table->string('autoridade_funcao', 160)->nullable();
			$table->string('planilha_file')->nullable();
			$table->string('planilha_nome')->nullable();
			$table->string('nota_file', 120)->default('');
			$table->string('rg', 20)->nullable();
			$table->timestamp('criacao_dh')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('status', 45)->nullable()->default('pendente');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notacomparecimento');
	}

}
