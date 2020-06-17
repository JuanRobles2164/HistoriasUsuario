@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
  <!-- Para agregar nuevos alumnos al proyecto-->
  
  <h1><i class="fas fa-chart-line"></i> Agregar observacion a alumnos</h1>
  <form action="{{route('docente.postObservacionAlumnosProyecto', $proyecto->id)}}" method="POST">
    @csrf
    <br>
    <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Observaci&oacute;n</span>
        </div>
        <textarea class="form-control" aria-label="With textarea" name="observacion"></textarea>
    </div>
    <br>
      <table class="table table-hover">
        <thead class="bg-dark">
          <tr>
            <th scope="col">
            </th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Identificación</th>
            <th scope="col">Correo</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($alumnos as $alumno)
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="id_alumnos[]" value="{{$alumno->id}}" aria-label="...">
              </div>
            </td>
            <td>
              <label for="">{{$alumno->nombres}}</label>
            </td>
            <td>
              <label for="">{{$alumno->apellidos}}</label>
            </td>
            <td>
              <label for="">{{$alumno->identificacion}}</label>
            </td>
            <td>
              <label for="">{{$alumno->e_mail}}</label>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col" align="center" valign="top">
        <button type="submit" class="btn btn-success" style="align-items: center;">Agregar</button> 
      </div>
        
</form>
@endsection