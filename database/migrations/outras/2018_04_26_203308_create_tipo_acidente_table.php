<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoAcidenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_acidente', function(Blueprint $table)
		{
			$table->string('id_tipo_acidente', 45)->primary();
			$table->string('tipo_acidente', 45);
			$table->string('procedimento', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipo_acidente');
	}

}
