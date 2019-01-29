<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMunicipioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipio', function(Blueprint $table)
		{
			$table->string('UF', 2);
			$table->integer('id_municipio')->primary();
			$table->string('municipio', 100);
			$table->string('nomecomacento', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('municipio');
	}

}
