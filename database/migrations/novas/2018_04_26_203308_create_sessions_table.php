<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function(Blueprint $table)
		{
			$table->string('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->text('user_agent', 65535)->nullable();
			$table->text('payload', 65535);
			$table->integer('last_activity');
			$table->string('nome');
			$table->string('rg', 30);
			$table->string('classe', 4);
			$table->string('nascimento', 30);
			$table->string('sexo', 15);
			$table->string('email', 45);
			$table->string('cargo', 15);
			$table->string('quadro', 10);
			$table->string('subquadro', 5);
			$table->string('referencia', 10);
			$table->string('cidade', 45);
			$table->string('opm', 45);
			$table->string('cdopm', 15);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessions');
	}

}
