<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evidencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencia', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('foto');
            $table->timestamps();
            
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
        Schema::dropIfExists('evidencia');
    }
}
