<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApresentacaocondicaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apresentacaocondicao', function(Blueprint $table)
		{
			$table->bigInteger('id_apresentacaocondicao', true);
			$table->string('apresentacaocondicao', 50)->nullable();
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
		Schema::drop('apresentacaocondicao');
	}

}
