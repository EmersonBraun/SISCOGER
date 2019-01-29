<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApresentacaoclassificacaosigiloTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apresentacaoclassificacaosigilo', function(Blueprint $table)
		{
			$table->bigInteger('id_apresentacaoclassificacaosigilo', true);
			$table->string('apresentacaoclassificacaosigilo', 50)->nullable();
			$table->smallInteger('ativo')->nullable()->default(1);
			$table->smallInteger('ordem')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apresentacaoclassificacaosigilo');
	}

}
