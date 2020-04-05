<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioEntrevistado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_entrevistado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('e_mail', 50)->unique();
            $table->string('telefono');
            $table->string('cargo');
            //lo comento pues creo que se puede calcular en base a las actividades
            //$table->float('costo', 12, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_entrevistado');
    }
}
