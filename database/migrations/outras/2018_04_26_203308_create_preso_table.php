<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preso', function(Blueprint $table)
		{
			$table->bigInteger('id_preso', true);
			$table->string('rg', 18);
			$table->string('nome', 150);
			$table->string('cargo', 20);
			$table->string('cdopm_quandopreso', 12);
			$table->string('cdopm_prisao', 12);
			$table->string('localreclusao', 150);
			$table->string('local', 15);
			$table->string('processo', 120);
			$table->string('natureza', 120);
			$table->string('complemento', 250);
			$table->string('numeromandado', 60);
			$table->integer('id_presotipo');
			$table->string('origem_proc', 10);
			$table->integer('origem_sjd_ref');
			$table->integer('origem_sjd_ref_ano');
			$table->string('origem_opm', 24);
			$table->date('inicio_data')->nullable();
			$table->date('fim_data')->nullable();
			$table->string('vara', 80);
			$table->string('comarca', 120);
			$table->text('obs_txt', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('preso');
	}

}
