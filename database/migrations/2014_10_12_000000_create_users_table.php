<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('usuario_crea');
            $table->dateTime('creado_en')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('usuario_modifica');
            $table->dateTime('modificado_en')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->dateTime('eliminado_en')->nullable();
            $table->tinyInteger('estado_eliminado');
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('username', 50)->unique();
            $table->string('contrasenia');
            $table->string('identificacion', 50)->unique();
            $table->string('e_mail', 50)->unique();
            $table->unsignedBigInteger('rol_id')->nullable();
            //$table->unsignedBigInteger('usuario_crea');
            $table->dateTime('creado_en')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('usuario_modifica');
            $table->dateTime('modificado_en')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->dateTime('eliminado_en')->nullable();
            $table->tinyInteger('estado_eliminado');
            $table->foreign('rol_id')->references('id')->on('roles');
        });
        DB::insert("INSERT INTO `roles`(`id`, `abreviatura`, `nombre`, `descripcion`, `usuario_crea`, `creado_en`, `usuario_modifica`, `modificado_en`,  `estado_eliminado`) VALUES (1,'SUPER_ADMIN','Super Administrador','Control total sobre el sistema',0,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP,0), (2, 'ALUMNO', 'Estudiante del sistema', 'El que realiza proyectos y trabajos', 0, CURRENT_TIMESTAMP, 0, CURRENT_TIMESTAMP, 0), (3, 'DOCENTE', 'Docente de la institución', 'Crea proyectos y los supervisa', 0, CURRENT_TIMESTAMP, 0, CURRENT_TIMESTAMP, 0)");
        DB::insert("INSERT INTO `usuarios`(`nombres`, `apellidos`, `username`, `contrasenia`, `identificacion`, `e_mail`, `rol_id`, `creado_en`, `usuario_modifica`, `modificado_en`, `estado_eliminado`) VALUES ('Juan Esteban','Robles Chanagá','JuanRobles','ek0fJgfe1Y0APDAncbPjzsPMgL8PLphypGNStDzeYhBQ/Y4W0sAbSTdQLhMbmvgCb9rrB9vZkGZZP9z20aOQ31','1005109076','jrobles4@udi.edu.co',1,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP,0)");
        //DB::insert("INSERT INTO `historiasusuario`.`usuarios`(`nombre`, `contrasenia`, `e_mail`, `rol_id`, `usuario_crea`, `creado_en`, `usuario_modifica`, `modificado_en`, `eliminado_en`, `estado_eliminado`) VALUES ('JUANROBLES', 'ek0fJgfe1Y0APDAncbPjzsPMgL8PLphypGNStDzeYhBQ/Y4W0sAbSTdQLhMbmvgCb9rrB9vZkGZZP9z20aOQ31', 'jrobles4@udi.edu.co', 1, 0, '2020-03-11 22:00:46', 0, '2020-03-11 22:00:46', NULL, 0);");
        //Prueba de pusheo
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
