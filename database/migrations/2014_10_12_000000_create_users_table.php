<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abreviatura', 15)->unique();
            $table->string('nombre');
            $table->string('descripcion',1024);
            $table->dateTime('creado_en');
            $table->dateTime('modificado_en');
            $table->dateTime('eliminado_en');
            $table->tinyInteger('estado_eliminado');
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('contrasenia');
            $table->string('e_mail')->unique();
            $table->dateTime('creado_en');
            $table->dateTime('modificado_en');
            $table->dateTime('eliminado_en');
            $table->tinyInteger('estado_eliminado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('usuarios');
    }
}
