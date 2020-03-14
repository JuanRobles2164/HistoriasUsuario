<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoUsuarioActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_usuario_actividad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_grupo_usuario');
            $table->unsignedBigInteger('id_actividad');
            $table->timestamps();
            
            $table->foreign('id_grupo_usuario')->references('id')->on('grupo_usuario');
            $table->foreign('id_actividad')->references('id')->on('actividad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_usuario_actividad');
    }
}
