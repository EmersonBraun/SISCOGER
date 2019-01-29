<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLigacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ligacao', function(Blueprint $table)
		{
			$table->bigInteger('id_ligacao', true);
			$table->string('origem_opm', 24);
			$table->integer('origem_sjd_ref');
			$table->integer('origem_sjd_ref_ano');
			$table->string('origem_proc', 20);
			$table->integer('destino_sjd_ref')->index('IXLDESTINOREF');
			$table->integer('destino_sjd_ref_ano')->index('IXLDESTINOANO');
			$table->string('destino_proc', 20);
			$table->bigInteger('id_adl')->nullable()->index('IXLADL');
			$table->bigInteger('id_apfd')->nullable()->index('IXLAPFD');
			$table->bigInteger('id_cd')->nullable()->index('IXLCD');
			$table->bigInteger('id_cj')->nullable()->index('IXLCJ');
			$table->bigInteger('id_desercao')->nullable()->index('IXLDESERCAO');
			$table->bigInteger('id_fatd')->nullable()->index('IXLFATD');
			$table->bigInteger('id_ipm')->nullable()->index('IXLIPM');
			$table->bigInteger('id_iso')->nullable()->index('IXLISO');
			$table->bigInteger('id_it')->nullable()->index('IXLIT');
			$table->bigInteger('id_sindicancia')->nullable()->index('IXLSINDICANCIA');
			$table->integer('id_preso')->nullable()->index('IXLPRESO');
			$table->integer('id_falecimento');
			$table->bigInteger('id_sai')->nullable();
			$table->bigInteger('id_proc_outros')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ligacao');
	}

}
