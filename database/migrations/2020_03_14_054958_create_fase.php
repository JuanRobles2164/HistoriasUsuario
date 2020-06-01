<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_limite');
            $table->string('miniatura_fase')->nullable();
            $table->unsignedBigInteger('id_metodologia');
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_estado');
            $table->timestamps();

            $table->foreign('id_metodologia')->references('id')->on('metodologia');
            $table->foreign('id_proyecto')->references('id')->on('proyecto');
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
        Schema::dropIfExists('fase');
    }
}
