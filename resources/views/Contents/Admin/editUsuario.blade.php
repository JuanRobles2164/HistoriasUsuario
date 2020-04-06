@extends('Templates/Admin/_LayoutAdmin')
@section('contenido')
    <form action="{{route('admin.postEdit')}}" method="POST">
        @csrf
        <div class="container-fluid">
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend> <i class="fas fa-user-edit"></i> &nbsp; Editar Iformación </legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-offset-2 col-lg-4">
                                <div class="from-group">
                                    <label for=""></label>
                                    <input type="hidden" name="id" value="{{$usuario->id}}" id="id">
                                </div>

                                <div class="from-group">
                                    <label for="">Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" id="" value="{{$usuario->nombres}}">
                                </div>

                                <div class="from-group">
                                    <label for="">Apellidos:</label>
                                    <input type="text" class="form-control" name="apellidos" id="" value="{{$usuario->apellidos}}">
                                </div>

                                <div class="from-group">
                                    <label for="">Identificacion:</label>
                                    <input type="text" class="form-control" name="identificacion" id="" value="{{$usuario->identificacion}}">
                                </div>

                                <div class="from-group">
                                    <label for="">Nombre de usuario:</label>
                                    <input type="text" class="form-control" name="username" id="" value="{{$usuario->username}}">
                                </div>

                                <div class="from-group">
                                    <label for="">Correo electrónico:</label>
                                    <input type="text" class="form-control" name="email" id="" value="{{$usuario->e_mail}}">
                                </div>

                                <div class="from-group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" class="form-control" name="contrasenia" id="" value="{{$usuario->contrasenia}}">
                                </div>
                                <br>
                                <div class="from-group">
                                    <button  type="submit" class="btn btn-outline-secondary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </form>
@endsection