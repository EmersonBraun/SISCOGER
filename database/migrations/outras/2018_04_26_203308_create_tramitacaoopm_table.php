<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTramitacaoopmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tramitacaoopm', function(Blueprint $table)
		{
			$table->bigInteger('id_tramitacaoopm', true);
			$table->string('rg', 24)->index('IX_RG');
			$table->string('cargo', 12);
			$table->string('nome', 120);
			$table->string('rg_cadastro', 24);
			$table->date('data');
			$table->string('cdopm', 12);
			$table->string('opm_abreviatura', 36);
			$table->text('descricao_txt', 65535)->index('TEXTO');
			$table->string('digitador', 120);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tramitacaoopm');
	}

}
