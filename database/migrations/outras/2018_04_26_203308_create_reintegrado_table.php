<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReintegradoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reintegrado', function(Blueprint $table)
		{
			$table->bigInteger('id_reintegrado', true);
			$table->string('rg', 32);
			$table->string('cargo', 28);
			$table->string('nome', 180);
			$table->string('motivo', 50);
			$table->string('procedimento', 20);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->date('retorno_data');
			$table->integer('bg_numero');
			$table->integer('bg_ano');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reintegrado');
	}

}
