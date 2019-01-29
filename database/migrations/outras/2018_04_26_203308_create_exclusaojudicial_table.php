<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExclusaojudicialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exclusaojudicial', function(Blueprint $table)
		{
			$table->bigInteger('id_exclusaojudicial', true);
			$table->string('rg', 32);
			$table->string('cargo', 32);
			$table->string('nome', 250);
			$table->string('cdopm_quandoexcluido', 12);
			$table->string('origem_proc', 12);
			$table->integer('origem_sjd_ref');
			$table->integer('origem_sjd_ref_ano');
			$table->string('origem_opm', 32);
			$table->string('processo', 250);
			$table->string('complemento', 250);
			$table->string('vara', 250);
			$table->string('numerounico', 60);
			$table->date('data');
			$table->date('exclusao_data');
			$table->text('obs_txt', 65535);
			$table->integer('portaria_numero');
			$table->integer('bg_numero');
			$table->integer('bg_ano');
			$table->integer('prioridade')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exclusaojudicial');
	}

}
