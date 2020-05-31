<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('prioridad');
            $table->string('secuencia');
            $table->string('estado');
            $table->string('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            //lo comento pues creo que se puede calcular en base a las actividades
            //$table->float('costo', 12, 2); 
            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('id_modulo');
            $table->unsignedBigInteger('id_usuario_entrevistado');
            $table->timestamps();
            $table->foreign('id_actividad')->references('id')->on('actividad');
            $table->foreign('id_modulo')->references('id')->on('modulo');
            $table->foreign('id_usuario_entrevistado')->references('id')->on('usuario_entrevistado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historia_usuario');
    }
}
