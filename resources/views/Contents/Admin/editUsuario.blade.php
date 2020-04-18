@extends('Templates/Admin/_LayoutAdmin')
@section('contenido')
    <form action="{{route('admin.postEdit')}}" method="POST">
        @csrf
        <div class="container-fluid" style="margin:10px 110px;">
            <br>
            <form class="from-neon" autocomplete="off">
                <fieldset>
                    <legend style="margin:20px 310px;"> <i class="fas fa-user-edit"></i> &nbsp; Editar Iformación </legend>
                        <div class="form-row">
                            <div class="">
                                <label for=""></label>
                                <input type="hidden" name="id" value="{{$usuario->id}}" id="id">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Nombres:</label>
                                <input type="text" class="form-control" name="nombres" id="" value="{{$usuario->nombres}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Apellidos:</label>
                                <input type="text" class="form-control" name="apellidos" id="" value="{{$usuario->apellidos}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Identificacion:</label>
                                <input type="text" class="form-control" name="identificacion" id="" value="{{$usuario->identificacion}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="username" id="" value="{{$usuario->username}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Correo electrónico:</label>
                                <input type="text" class="form-control" name="email" id="" value="{{$usuario->e_mail}}">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" id="" value="{{$usuario->contrasenia}}">
                            </div>
                            <br>
                        </div>
                        <div style="margin:40px 390px;">
                            <button  type="submit" class="btn btn-outline-secondary btn-lg">Editar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </form>
@endsection