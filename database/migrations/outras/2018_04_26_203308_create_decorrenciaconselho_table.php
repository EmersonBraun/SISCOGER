<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDecorrenciaconselhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('decorrenciaconselho', function(Blueprint $table)
		{
			$table->integer('id_decorrenciaconselho', true);
			$table->string('decorrenciaconselho', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('decorrenciaconselho');
	}

}
