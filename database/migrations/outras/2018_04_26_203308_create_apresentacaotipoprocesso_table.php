<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApresentacaotipoprocessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apresentacaotipoprocesso', function(Blueprint $table)
		{
			$table->bigInteger('id_apresentacaotipoprocesso', true);
			$table->string('apresentacaotipoprocesso', 50)->nullable();
			$table->string('procedimentointerno', 100)->nullable()->default('');
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
		Schema::drop('apresentacaotipoprocesso');
	}

}
