@extends('/Templates/Docente/_LayoutDocente')
@section('contenido')
  <!-- Para agregar nuevos alumnos al proyecto-->
  <h1><i class="fas fa-chart-line"></i> Supervisando: {{$proyecto->nombre}}</h1>
  <br>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="btn btn-primary">Nuevo grupo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> </a>
        </li>
        <li class="nav-item">
          <button type="submit" class="btn btn-success">Agregar</button>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar Estudiante">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Buscar</button>
      </form>
    </div>
  </nav>
  <form action="{{route('docente.postAsignarAlumnoProyecto', $proyecto->id)}}" method="POST">
    @csrf
    <br>
      <table class="table table-hover table-dark">
        <thead>
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
          <tr>
            <th scope="row">
              <div class="form-check">
                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
              </div>
            </th>
            <td>
              @foreach ($alumnos as $alumno)
                <label for="">{{$alumno->nombres}}</label>
              @endforeach
            </td>
            <td>
              @foreach ($alumnos as $alumno)
              <label for="">{{$alumno->identificacion}}</label>
              @endforeach
            </td>
            <td>
              @foreach ($alumnos as $alumno)
                <label for="">{{$alumno->e_mail}}</label>
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
  </form>
@endsection