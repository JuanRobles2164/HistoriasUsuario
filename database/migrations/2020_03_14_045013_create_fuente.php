<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_metodologia');
            $table->timestamps();

            //FKs
            $table->foreign('id_metodologia')->references('id')->on('metodologia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuente');
    }
}
