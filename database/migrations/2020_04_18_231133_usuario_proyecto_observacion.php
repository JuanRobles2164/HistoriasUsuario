<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioProyectoObservacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion_grupo_usuario', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('observacion');
            $table->unsignedBigInteger('grupo_usuario_id');
            $table->foreign('grupo_usuario_id')->references('id')->on('grupo_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacion_grupo_usuario');
    }
}
