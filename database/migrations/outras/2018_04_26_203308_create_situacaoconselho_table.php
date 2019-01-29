<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSituacaoconselhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('situacaoconselho', function(Blueprint $table)
		{
			$table->integer('id_situacaoconselho', true);
			$table->string('situacaoconselho', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('situacaoconselho');
	}

}
