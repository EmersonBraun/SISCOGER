<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAndamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('andamento', function(Blueprint $table)
		{
			$table->integer('id_andamento', true);
			$table->string('andamento', 40);
			$table->string('procedimento', 24);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('andamento');
	}

}
