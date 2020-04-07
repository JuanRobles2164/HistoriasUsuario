@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
    <br>
    <h3>Trabajando las fases del proyecto: {{$proyecto->nombre}}</h3>
    <br>
    <div class="container-sm">
        <div class="row">
            <form action="{{route('alumno.postAgregarFase', $proyecto->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card " style="width: 18rem;">
                    <img src="{{URL::asset('Images/Resources/registrese.png')}}" class="card-img-top" alt="imagen de ejemplo" height="150">
                    <div class="card-body">
                        <input type="hidden" name="id_metodologia" value="{{$proyecto->id_metodologia}}">
                        <input type="hidden" name="id_proyecto" value="{{$proyecto->id}}">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="descripcion_fase">Descripcion:</label>
                        <input type="text" name="descripcion" id="descripcion_fase">
                        <label for="fecha_limite">Fecha límite</label>
                        <input type="date" name="fecha_limite" id="fecha_limite">
                        <label for="miniatura_fase">Imagen</label>
                        <input type="file" name="miniatura_fase" id="miniatura_fase">
                        <button type="submit" class="btn btn-success">+</button>
                        <br>
                    </div>
                  </div>
            </form>
            @if ($fases != null)
            @foreach ($fases as $fase)
            <div class="col-xs-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset('storage').'/'.$fase->miniatura_fase}}" class="card-img-top" alt="imagen de ejemplo" width="300" height="150">
                    <div class="card-body">
                        <h5>{{$fase->nombre}}</h5>
                        <p>{{$fase->descripcion}}</p>
                        <a href="{{route('alumno.getEditarFase', array('id_proyecto' => $fase->id_proyecto, 'id_fase' => $fase->id))}}" class="btn btn-warning">Editar</a>
                        <a href="{{route('alumno.getTrabajarEnFaseModulos', array('id_proyecto' => $fase->id_proyecto, 'id_fase' =>$fase->id))}}" class="btn btn-primary">Trabajar</a>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        </div>

    </div>
@endsection