<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiponotacomparecimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tiponotacomparecimento', function(Blueprint $table)
		{
			$table->bigInteger('id_tiponotacomparecimento', true);
			$table->string('nomeunico', 160);
			$table->string('tiponotacomparecimento', 160);
			$table->smallInteger('ativo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tiponotacomparecimento');
	}

}
