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
        Schema::create('observacion_usuario_proyecto', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('observacion');
            $table->unsignedBigInteger('proyecto_usuario_union_id');
            $table->foreign('proyecto_usuario_union_id')->references('id')->on('usuario_proyecto_union');
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
