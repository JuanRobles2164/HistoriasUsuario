@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
  <!-- Para agregar nuevos alumnos al proyecto-->
  <h1><i class="fas fa-chart-line"></i> Agregar usuarios a {{$grupo->nombre}}</h1>
  <br>

  <form action="{{route('docente.postAsignarAlumnoGrupo',  array('id_proyecto' => $grupo->id_proyecto, 'id_grupo' => $grupo->id))}}" method="POST">
    @csrf
    <nav class="navbar navbar-expand-lg navbar-light bg-light">  
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <button type="submit" class="btn btn-success">Agregar</button>
            </li>
        </ul>
    </nav> 
    <br>
      <table class="table table-hover">
        <thead class="bg-dark">
          <tr>
            <th scope="col">
              <div class="form-check">
                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
              </div>
            </th>
            <th scope="col">Nombre</th>
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
              <label for="">{{$alumno->identificacion}}</label>
            </td>
            <td>
              <label for="">{{$alumno->e_mail}}</label>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </form>
@endsection