<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('log_name')->nullable();
			$table->text('description', 65535);
			$table->integer('subject_id')->nullable();
			$table->string('subject_type')->nullable();
			$table->integer('causer_id')->nullable();
			$table->string('causer_type')->nullable();
			$table->text('properties', 65535)->nullable();
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
		Schema::drop('activity_log');
	}

}
