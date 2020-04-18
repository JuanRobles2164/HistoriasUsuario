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
        Schema::create('usuario_proyecto_observacion', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('observacion');
            $table->unsignedBigInteger('proyecto_usuario_union_id');
            $table->foreign('proyecto_usuario_union_id')->references('id')->on('proyecto_usuario_union');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_proyecto_observacion');
    }
}
