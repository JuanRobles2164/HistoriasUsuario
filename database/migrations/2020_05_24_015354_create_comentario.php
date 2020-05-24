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
            $table->unsignedBigInteger('grupo_usuario_id');
            //El email del docente que hace el comentario
            $table->string('email_usuario')->index();
            $table->boolean('estado')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('comentario');
    }
}
