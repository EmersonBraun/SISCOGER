<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObjetoprocedimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('objetoprocedimento', function(Blueprint $table)
		{
			$table->string('id_objetoprocedimento', 30)->primary();
			$table->string('objetoprocedimento', 30);
			$table->string('procedimento', 30);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('objetoprocedimento');
	}

}
