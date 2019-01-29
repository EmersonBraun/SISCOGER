<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViaturaenvolvidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('viaturaenvolvida', function(Blueprint $table)
		{
			$table->bigInteger('id_viaturaenvolvida')->primary();
			$table->bigInteger('id_sai');
			$table->string('placa', 45);
			$table->string('prefixo', 45);
			$table->string('situacao', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('viaturaenvolvida');
	}

}
