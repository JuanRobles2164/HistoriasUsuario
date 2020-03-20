@extends('Home-admin')
@section('contenido')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<br>
<h3>Lista de usuarios</h3>
<br>
<center> 
    <table class="table table-hover" style="line-height: 400px;">
        <thead class="thead-dark">
        <tr>
            <th scope="col" valign="middle" style="text-align: center">Nombre completo</th>
            <th scope="col" valign="middle" style="text-align: center">Identificacion</th>
            <th scope="col" valign="middle" style="text-align: center">Correo</th>
            <th scope="col" valign="middle" style="text-align: center">Rol</th>
            <th scope="col" valign="middle" style="text-align: center">Acciones</th>
        </tr>
        </thead>
        @foreach ($usuarios as $usuario)
                <tr style="border-color: black; border-radius: 1px; vertical-align:middle; height:100%">
                    <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$usuario->nombres.' '.$usuario->apellidos}}</td>
                    <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$usuario->identificacion}}</td>
                    <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$usuario->e_mail}}</td>
                    <td scope="row" valign="middle" align="center" style="line-height: 30px;">{{$usuario->abreviatura}}</td>
                    <td scope="row" valign="middle" align="center" style="line-height: 30px;"s>
                        <a href="#" class="btn btn-info btn-sm">  
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </a>
                        <a href="{{route('admin.getEdit', 'id='.$usuario->id)}}" <a class="btn btn-success btn-sm">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="#" <a class="btn btn-warning btn-sm">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        
                    </td>
                </tr>
            @endforeach
      </table>
</center>
</body>
</html>
@endsection