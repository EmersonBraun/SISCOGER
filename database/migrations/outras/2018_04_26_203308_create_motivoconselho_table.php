<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMotivoconselhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('motivoconselho', function(Blueprint $table)
		{
			$table->boolean('id_motivoconselho')->primary();
			$table->string('motivoconselho', 120);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('motivoconselho');
	}

}
