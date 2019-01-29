<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestricaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restricao', function(Blueprint $table)
		{
			$table->bigInteger('id_restricao', true);
			$table->string('rg', 18);
			$table->string('cargo', 18);
			$table->string('nome', 120);
			$table->string('fardamento_bl', 1);
			$table->string('arma_bl', 1);
			$table->string('origem', 30);
			$table->date('cadastro_data');
			$table->date('inicio_data')->nullable();
			$table->date('fim_data');
			$table->date('retirada_data')->nullable();
			$table->string('proc', 12);
			$table->integer('sjd_ref');
			$table->integer('sjd_ref_ano');
			$table->text('obs_txt', 16777215);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restricao');
	}

}
