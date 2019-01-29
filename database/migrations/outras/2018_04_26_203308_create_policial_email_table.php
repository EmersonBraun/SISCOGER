<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePolicialEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('policial_email', function(Blueprint $table)
		{
			$table->bigInteger('rg')->primary();
			$table->string('email', 160);
			$table->string('usuario_rg', 160)->nullable();
			$table->timestamp('dh')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('policial_email');
	}

}
