@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Trabajando en el proyecto: {{$proyecto->nombre}}</h3>
    <br>
    <div class="container-sm">
        @if ($fases != null)
            @foreach ($fases as $fase)
                <div class="card" style="width: 18rem;">
                    <img src="{{URL::asset('Images/Resources/log-udi-web.png')}}" class="card-img-top" alt="imagen de ejemplo" width="100" height="50">
                    <div class="card-body">
                        <h5>{{$fase->nombre}}</h5>
                        <p>{{$fase->descripcion}}</p>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-primary">Trabajar</a>
                    </div>
                </div>
                <br>
            @endforeach
        @endif
        <form action="{{route('alumno.postAgregarFase', $proyecto->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card " style="width: 18rem;">
                <img src="{{URL::asset('Images/Resources/registrese.png')}}" class="card-img-top" alt="imagen de ejemplo" width="200" height="100">
                <div class="card-body">
                    <input type="hidden" name="id_metodologia" value="{{$proyecto->id_metodologia}}">
                    <input type="hidden" name="id_proyecto" value="{{$proyecto->id}}">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre">
                    <label for="descripcion_fase">Descripcion:</label>
                    <input type="text" name="descripcion" id="descripcion_fase">
                    <label for="fecha_limite">Fecha límite</label>
                    <input type="date" name="fecha_limite" id="fecha_limite">
                    <label for="miniatura_fase">Imagen</label>
                    <input type="file" name="miniatura_fase" id="miniatura_fase">
                    <button type="submit" class="btn btn-success">+</button>
                    
                </div>
              </div>
        </form>
    </div>
@endsection