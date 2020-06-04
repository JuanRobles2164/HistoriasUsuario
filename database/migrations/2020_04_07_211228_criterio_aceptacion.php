<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriterioAceptacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterio_aceptacion', function(Blueprint $table){
        $table->bigIncrements('id');
        $table->string('nombre');
        $table->string('contexto');
        $table->string('evento');
        $table->string('resultado');
        $table->string('cumple');
        $table->unsignedBigInteger('id_historia_usuario');
		$table->foreign('id_historia_usuario')->references('id')->on('historia_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterio_aceptacion');
    }
}
