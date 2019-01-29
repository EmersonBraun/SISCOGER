<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFalecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('falecimento', function(Blueprint $table)
		{
			$table->integer('id_falecimento', true);
			$table->string('rg', 32);
			$table->string('cargo', 32);
			$table->string('nome', 250);
			$table->date('data');
			$table->integer('id_municipio');
			$table->string('endereco', 250);
			$table->string('endereco_numero', 60);
			$table->string('cdopm', 12);
			$table->integer('bou_ano');
			$table->string('bou_numero', 7);
			$table->integer('id_situacao');
			$table->string('resultado', 22);
			$table->text('descricao_txt', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('falecimento');
	}

}
