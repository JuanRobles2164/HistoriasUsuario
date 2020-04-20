<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_proyecto_union', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_proyecto');
            $table->string('observacion');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_proyecto')->references('id')->on('proyecto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_proyecto_union');
    }
}
