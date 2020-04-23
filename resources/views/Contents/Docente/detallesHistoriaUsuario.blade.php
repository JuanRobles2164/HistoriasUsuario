@extends('Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Detalles de la historia de usuario</h3>
    <br>
    <form>
        <fieldset disabled>
        <div class=form-group>
            <label for="">Secuencia</label>
            <input type="text" value="{{$historia->secuencia}}">
        </div>
        <div class=form-group>
            <label for="">Nombre</label>
            <input type="text" value="{{$historia->nombre}}">
        </div>
        <div class=form-group>
            <label for=""></label>
            <input type="text" value="{{$historia->estado}}">
        </div>
        <div class=form-group>
            <label for=""></label>
            <textarea type="text">{{$historia->descripcion}}</textarea>
        </div>
        <div class=form-group>
            <label for="">Fecha de inicio</label>
            <input type="text" value="{{$historia->fecha_inicio}}">
        </div>
        <div class=form-group>
            <label for="">Fecha de fin</label>
            <input type="text" value="{{$historia->fecha_fin}}">
        </div>
        <div class=form-group>
            <label for="">Creado en: </label>
            <input type="text" value="{{$historia->created_at}}">
        </div>
        <div class=form-group>
            <table class="table table-sm">
                <thead>
                    <tr class="bg-dark">
                        <th>Compromisos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compromisos as $compromiso)
                        <tr>
                            <td>
                                {{$compromiso->descripcion}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class=form-group>
            <label for="">Evidencias</label>
            <table class="table table-sm">
                <thead>
                    <tr class="bg-dark">
                        <th>Nombre</th>
                        <th>Foto</th>
                        <th>Fecha de creacion:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evidencias as $evidencia)
                        <tr>
                            <td>
                                {{$evidencia->nombre}}
                            </td>
                            <td>
                                Aquí va una imagen XD
                            </td>
                            <td>
                                {{$evidencia->created_at}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </fieldset>
      </form>
@endsection