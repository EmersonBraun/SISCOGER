<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadastroopmcogerautoridadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadastroopmcogerautoridade', function(Blueprint $table)
		{
			$table->bigInteger('id_cadastroopmcogerautoridade', true);
			$table->bigInteger('id_cadastroopmcoger')->nullable();
			$table->string('rg', 80)->nullable();
			$table->string('funcao', 160)->nullable();
			$table->smallInteger('ativado')->nullable()->default(1);
			$table->timestamp('dh')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('usuario_rg', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cadastroopmcogerautoridade');
	}

}
