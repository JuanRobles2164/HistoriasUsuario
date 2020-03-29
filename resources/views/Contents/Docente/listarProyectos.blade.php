@extends('Templates/Docente/_LayoutDocente')
@section('contenido')
<br>
<h3>Proyectos</h3>
<br>
<p>Aquí estarán los proyectos que usted alguna vez creó o que actualmente está supervisando</p>
<br>
    <table class="table">
        <thead>
            <tr class="bg-primary">
                <td style="text-align: center;">Nombre</td>
                <td style="text-align: center;">Descripcion</td>
                <td style="text-align: center;">Fecha límite (YYYY-MM-dd)</td>
                <td style="text-align: center;">días restantes</td>
                <td style="text-align: center;">Estado</td>
                <td style="text-align: center;">Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <th style="text-align: center;">{{$proyecto->nombre}}</th>
                    <th style="text-align: center;">{{$proyecto->descripcion}}</th>
                    <th style="text-align: center;">{{$proyecto->fecha_limite}}</th>
                    <th style="text-align: center;">{{($proyecto->dias_restantes)}}</th>
                    @if ($proyecto->id_estado == 1)
                        <th style="text-align: center;">
                            <a class="btn btn-success">Activo</a>
                        </th>
                    @else
                        <th style="text-align: center;">
                            <a class="btn btn-danger">Inactivo</a>
                        </th>
                    @endif
                    <th style="text-align: center;">
                        <!-- Propongo que en el botón de "detalles" salgan reportes del proyecto-->
                        <!-- Por ejemplo: Cantidad de grupos en el proyecto... numero de alumnos por grupo-->
                        <!-- Y cosas así XD -->
                        <a href="#" class="btn btn-success" aria-placeholder="Detalles">Detalles</a>
                        <a href="#" class="btn btn-info" aria-placeholder="Detalles">Supervisar</a>
                        <a href="{{route('docente.getEditarProyecto', 'id='.$proyecto->id)}}" class="btn btn-warning" aria-placeholder="Editar">Editar</a>
                        <a href="{{route('docente.getAlternarEstadoProyecto', 'id='.$proyecto->id."&id_estado=".$proyecto->id_estado)}}" class="btn btn-danger" placeholder="Suspender">Eiminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection