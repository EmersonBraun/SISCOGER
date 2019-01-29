<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApresentacaomassificadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apresentacaomassificado', function(Blueprint $table)
		{
			$table->bigInteger('id_apresentacaomassificado', true);
			$table->string('cdopm', 20)->nullable();
			$table->string('nome_original_do_arquivo', 160)->nullable();
			$table->timestamp('datahora')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('nome_do_arquivo', 160)->nullable();
			$table->string('nome_da_folha', 160)->nullable();
			$table->integer('qtde_registros')->nullable();
			$table->integer('qtde_registros_inconsistentes')->nullable();
			$table->smallInteger('situacao')->nullable()->default(0);
			$table->string('usuario_rg', 20)->nullable();
			$table->bigInteger('id_notacomparecimento')->nullable();
			$table->bigInteger('id_apresentacaocondicao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apresentacaomassificado');
	}

}
