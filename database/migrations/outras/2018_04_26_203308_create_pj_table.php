<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePjTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pj', function(Blueprint $table)
		{
			$table->integer('id_pj', true);
			$table->integer('id_pad');
			$table->string('cnpj', 18);
			$table->string('razaosocial', 180);
			$table->string('contato', 60);
			$table->string('telefone', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pj');
	}

}
