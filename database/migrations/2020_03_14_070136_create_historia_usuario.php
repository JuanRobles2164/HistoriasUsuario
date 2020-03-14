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
            $table->integer('estado');
            $table->string('observacion');
            $table->string('descripcion');
            $table->date('fecha_realizado');
            $table->integer('dias');
            //lo comento pues creo que se puede calcular en base a las actividades
            //$table->float('costo', 12, 2); 
            $table->string('usuario_entrevistado');
            $table->string('cargo');
            $table->string('email');
            $table->string('telefono');
            $table->string('control_seguimiento');

            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('id_tema');

            $table->timestamps();

            $table->foreign('id_actividad')->references('id')->on('actividad');
            $table->foreign('id_tema')->references('id')->on('tema');
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
