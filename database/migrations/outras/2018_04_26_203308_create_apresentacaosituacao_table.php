<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApresentacaosituacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apresentacaosituacao', function(Blueprint $table)
		{
			$table->bigInteger('id_apresentacaosituacao')->primary();
			$table->string('apresentacaosituacao', 50)->nullable();
			$table->smallInteger('apresentacao_concluida')->nullable()->default(0);
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
		Schema::drop('apresentacaosituacao');
	}

}
