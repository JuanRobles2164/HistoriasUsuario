<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>PDF</title>
</head>
<body>

    
    <h2>HISTORIA DE USUARIO {{$historia->nombre}}</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    {{$historia->nombre.' - '.$historia->secuencia}}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CODIGO DE HISTORIA</td>
                <td>{{$historia->secuencia}}</td>
            </tr>
            <tr>
                <td>SECUENCIA</td>
                <td>{{$historia->secuencia}}</td>
            </tr>
            <tr>
                <td>FECHAS</td>
                <td>{{$historia->fecha_inicio.' - '.$historia->fecha_fin}}</td>
            </tr>
            <tr>
                <td>PRIORIDAD</td>
                <td>
                    @switch($historia->prioridad)
                        @case(1)
                            <div class="alert alert-light" role="alert">
                                Muy baja
                            </div>
                            @break
                        @case(2)
                            <div class="alert alert-dark" role="alert">
                                Baja
                            </div>
                            @break
                        @case(3)
                            <div class="alert alert-info" role="alert">
                                Media
                            </div>
                            @break
                        @case(4)
                            <div class="alert alert-warning" role="alert">
                                Alta
                            </div>
                            @break
                        @default
                            <div class="alert alert-danger" role="alert">
                                Muy alta
                            </div>
                    @endswitch
                </td>
            </tr>
            <tr>
                <td>EVALUADOR</td>
                <td>Ricardo</td>
            </tr>
            <tr>
                <td>MODULO</td>
                <td>{{$modulo->nombre}}</td>
            </tr>
            <tr>
                <td>DESCRIPCION</td>
                <td>
                    <p>
                        {{$historia->descripcion}}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <h2>CRITERIOS DE ACEPTACION</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Contexto</th>
                <th>Evento</th>
                <th>Resultado</th>
                <th>¿Cumple?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criterios as $criterio)
                <tr>
                    <td>
                        <strong>
                            {{$loop->iteration}}
                        </strong>
                    </td>
                    <td>{{$criterio->nombre}}</td>
                    <td>{{$criterio->contexto}}</td>
                    <td>{{$criterio->evento}}</td>
                    <td>{{$criterio->resultado}}</td>
                    <td>{{$criterio->cumple}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2>EVIDENCIAS</h2>
    <table class="table table-striped">
        <tbody>
            @foreach ($evidencias as $evidencia)
                <tr>
                    <td>
                        <p>
                            {{$loop->iteration.'.'.$evidencia->nombre}}
                        </p>
                    </td>
                    <td>
                        <img src="{{$evidencia->foto}}" width="400">    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2>COMPROMISOS</h2>
    
    <table class="table table-striped">
        <tbody>
            @foreach ($compromisos as $compromiso)
            <tr>
                <td>
                    {{$loop->iteration.'.'.$compromiso->descripcion}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
