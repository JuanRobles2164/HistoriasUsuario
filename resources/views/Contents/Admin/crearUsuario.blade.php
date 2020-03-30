@extends('Templates/Admin/_LayoutAdmin')
@section('contenido')
    <form action="{{route('admin.postCreate')}}" method="POST">
        @csrf
        <div class="container-fluid">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div cass="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="usuario_nombre">Nombres</label>
                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="nombres" id="usuario_nombre" maxlength="45">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_apellido">Apellidos</label>
                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="apellidos" id="usuario_apellido" maxlength="45">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_cc">Identificacion</label>
                                    <input type="text" pattern="[a-zA-Z0-9-]{1,35}" class="form-control" name="identificacion" id="usuario_cc" maxlength="35">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_email">Correo electrónico</label>
                                    <input type="email" class="form-control" name="email" id="usuario_email" maxlength="70">
                                </div>

                                <div class="from-group">
                                    <label for="usuario_password">Contraseña</label>
                                    <input type="password" class="form-control" name="clave" id="contrasenia" maxlength="150">
                                </div>

                                <div class="form-group">
                                    <label for="usuario_rol">Seleccioné el Rol</label>
                                    <select class="form-control" name="rol">
                                        <option hidden>Seleccione una opción</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{$rol->id}}">{{$rol->abreviatura}}</option>    
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                    <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                    <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                </p>
            </form>
        </div>
    </form>
@endsection