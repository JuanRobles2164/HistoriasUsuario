<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_limite');

            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_metodologia');
            $table->unsignedBigInteger('id_estado');
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_metodologia')->references('id')->on('metodologia');
            $table->foreign('id_estado')->references('id')->on('estado');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto');
    }
}
