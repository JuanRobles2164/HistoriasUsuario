<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comentario');
            $table->unsignedBigInteger('id_grupo');
            //El email del docente que hace el comentario
            $table->boolean('estado')->default(false);
            $table->unsignedBigInteger('UsuarioVisto');
            $table->timestamps();
            $table->foreign('id_grupo')->references('id')->on('grupo_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario');
    }
}
