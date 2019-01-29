<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription', function(Blueprint $table)
		{
			$table->bigInteger('id_subscription', true);
			$table->string('nome', 120);
			$table->string('email', 120);
			$table->string('processo_tipo', 100);
			$table->bigInteger('processo_id');
			$table->boolean('ativo')->nullable();
			$table->string('observacao')->nullable();
			$table->unique(['processo_tipo','processo_id','email'], 'un_proc_email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscription');
	}

}
