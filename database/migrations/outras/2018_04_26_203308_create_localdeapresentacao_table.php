<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocaldeapresentacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localdeapresentacao', function(Blueprint $table)
		{
			$table->bigInteger('id_localdeapresentacao', true);
			$table->string('localdeapresentacao')->default('');
			$table->integer('id_municipio')->default(82362);
			$table->string('bairro', 100)->default('');
			$table->char('uf', 2)->default('PR');
			$table->string('logradouro', 100)->default('');
			$table->string('numero', 20)->default('');
			$table->string('complemento', 60)->default('');
			$table->char('cep', 10)->default(00000000);
			$table->string('telefone', 60)->default('');
			$table->bigInteger('id_genero')->nullable()->default(2);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('localdeapresentacao');
	}

}
