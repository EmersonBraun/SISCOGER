<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipopenalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipopenal', function(Blueprint $table)
		{
			$table->integer('TPCod');
			$table->integer('TICod');
			$table->integer('TPInciso');
			$table->integer('LGCod');
			$table->string('TPNomeJuridico', 150);
			$table->string('TPDispLegal', 80);
			$table->string('TPRitoEspecial', 3);
			$table->string('TPPermiteTCip', 3);
			$table->string('TPStatus', 3);
			$table->string('TIPolicia', 5);
			$table->integer('cdurgencia');
			$table->string('imprensa', 3);
			$table->string('msrepl_tran_version', 64);
			$table->string('ativo', 3);
			$table->text('TPConceito', 65535);
			$table->primary(['TPCod','TICod','TPInciso']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipopenal');
	}

}
