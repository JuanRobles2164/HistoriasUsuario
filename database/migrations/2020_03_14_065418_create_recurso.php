<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->float('valor_unitario', 12, 2);
            $table->float('cantidad', 12, 2);
            $table->unsignedBigInteger('id_tipo_recurso');
            $table->unsignedBigInteger('id_actividad');
            $table->timestamps();

            $table->foreign('id_tipo_recurso')->references('id')->on('tipo_recurso');
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
        Schema::dropIfExists('recurso');
    }
}
