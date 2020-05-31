<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compromiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compromiso', function(Blueprint $table){
        $table->bigIncrements('id');
        $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('compromiso');
    }
}
