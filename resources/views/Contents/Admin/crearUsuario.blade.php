@extends('Templates/Admin/_LayoutAdmin')
@section('contenido')
    <form action="{{route('admin.postCreate')}}" method="POST">
        @csrf
        <div class="container-fluid" style="margin:50px 150px;">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    @isset($mensaje)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <p>{{$mensaje}}</p>, ya puedes iniciar sesión.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endisset
                                    @error('nombres')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su nombre
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label for="usuario_nombre">Nombres</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="nombres" id="usuario_nombre" maxlength="45">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    @error('apellidos')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su apellido
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                        <div class="form-group mb-3">
                                            <label for="usuario_apellido">Apellidos</label>
                                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" class="form-control" name="apellidos" id="usuario_apellido" maxlength="45">
                                        </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    @error('identificacion')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar su identificaci&oacute;n o una que no este en uso
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label for="usuario_cc">Identificacion</label>
                                        <input type="text" pattern="[a-zA-Z0-9-]{1,35}" class="form-control" name="identificacion" id="usuario_cc" maxlength="35">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    @error('email')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar un email o uno que no este en uso
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label for="usuario_email">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" id="usuario_email" maxlength="70">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    @error('contrasenia')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> debe ingresar una contraseña
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label for="usuario_password">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasenia" id="contrasenia" maxlength="150">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    @error('rol_id')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡Hey!,</strong> seleccione un rol
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label for="usuario_rol">Seleccioné el Rol</label>
                                        <select class="form-control" name="rol_id">
                                            <option hidden>Seleccione una opción</option>
                                            @foreach ($roles as $rol)
                                                <option value="{{$rol->id}}">{{$rol->abreviatura}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 10px;">
                <div class="form-group col-md-4" style="margin: 40px 230px">
                    <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                    &nbsp;
                    <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                </div>
            </form>
        </div>
    </form>
@endsection