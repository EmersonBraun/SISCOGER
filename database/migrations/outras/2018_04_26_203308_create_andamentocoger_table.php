<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAndamentocogerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('andamentocoger', function(Blueprint $table)
		{
			$table->integer('id_andamentocoger', true);
			$table->string('andamentocoger', 50);
			$table->string('procedimento', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('andamentocoger');
	}

}
