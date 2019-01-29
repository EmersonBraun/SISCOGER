<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArquivosApagados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos_apagados', function (Blueprint $table) {
            $table->increments('id_arquivos_apagados');
            $table->string('procedimento');
            $table->integer('id_procedimento');
            $table->string('sjd_ref');
            $table->string('sjd_ref_ano');
            $table->string('rg');
            $table->string('nome');
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
        Schema::dropIfExists('arquivos_apagados');
    }
}
