@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Supervisando historias del grupo: {{$id_grupo}}</h3>
<br>
    <table class="table">
        <thead>
            <tr class="bg-primary">
                <th>Secuencia</th>
                <th>Nombre</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Fecha de inicio</th>
                <th>Fecha de realizacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historias as $historia)
                <tr>
                    <td>{{$historia->secuencia}}</td>
                    <td>{{$historia->nombre}}</td>
                    @switch($historia->prioridad)
                    @case(1)
                        <td>
                            <div class="alert alert-light" role="alert">
                                Muy baja
                            </div>
                        </td>
                        @break
                    @case(2)
                        <td>
                            <div class="alert alert-primary" role="alert">
                                Baja
                            </div>
                        </td>
                        @break
                    @case(3)
                        <td>
                            <div class="alert alert-success" role="alert">
                                Media
                            </div>
                        </td>
                        @break
                    @case(4)
                        <td>
                            <div class="alert alert-warning" role="alert">
                                Alta
                            </div>
                        </td>
                        @break
                    @default
                        <td>
                            <div class="alert alert-danger" role="alert">
                                Muy Alta
                            </div>
                        </td>
                @endswitch
                    <td>{{$historia->estado}}</td>
                    <td>{{$historia->fecha_inicio}}</td>
                    <td>{{$historia->fecha_fin}}</td>
                    <td>
                        <a href="#" class="btn btn-primary">Detalles</a>
                        <a href="#" class="btn btn-warning" data-toggle="modal">Observacion</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection