<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome');
			$table->string('rg');
			$table->string('password');
			$table->boolean('block');
			$table->boolean('termos');
			$table->string('classe');
			$table->string('cargo');
			$table->string('subquadro');
			$table->string('opm_descricao');
			$table->string('cdopm');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
