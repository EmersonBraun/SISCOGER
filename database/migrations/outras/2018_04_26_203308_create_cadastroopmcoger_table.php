<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCadastroopmcogerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cadastroopmcoger', function(Blueprint $table)
		{
			$table->bigInteger('id_cadastroopmcoger', true);
			$table->string('cdopm', 20)->nullable()->unique('cdopm_unico');
			$table->string('opm_nome_por_extenso', 100)->nullable();
			$table->bigInteger('id_municipio')->nullable();
			$table->string('opm_intermediaria_cdopm', 20)->nullable();
			$table->string('opm_intermediaria_nome_por_extenso', 100)->nullable();
			$table->string('opm_autoridade_rg', 80)->nullable();
			$table->string('opm_autoridade_cargo', 80)->nullable();
			$table->string('opm_autoridade_quadro', 80)->nullable();
			$table->string('opm_autoridade_subquadro', 80)->nullable();
			$table->string('opm_autoridade_nome', 160)->nullable();
			$table->string('opm_autoridade_funcao', 160)->nullable();
			$table->string('opm_autoridade_funcao_respondendo', 160)->nullable();
			$table->string('memorando_sigla', 60)->nullable();
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
		Schema::drop('cadastroopmcoger');
	}

}
