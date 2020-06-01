@extends('/Templates/Alumno/_LayoutAlumno')
@section('contenido')
<input type="hidden" name="api_route_get_modulos" id="api_route_get_modulos" value="{{route('alumno.select.getListaModulos')}}">
<input type="hidden" name="api_route_get_actividades" id="api_route_get_actividades" value="{{route('alumno.select.getListaActividades')}}">
<div class="card text-center shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card-header">
      <ul class="nav nav-pills card-header-pills">
          <li class="nav-item">
            <a class="nav-link disabled text-warning" href="#" tabindex="-1" aria-disabled="true">Historias de usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-select-tab" data-toggle="pill" href="#pills-select" role="tab" aria-controls="pills-select" aria-selected="false"><i class="fas fa-user-plus fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-user-plus fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-address-card fa-lg"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-table fa-lg"></i></a>
          </li>
      </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-select" role="tabpanel" aria-labelledby="pills-select-tab">
                <!-- Formulacio para crear historias de usuario-->
                <h5>Gestionar Historia de Usuario</h5>
                <!--Este es el form para agregar a un usuario entrevistado-->
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Fase</label>
                            <a href="" class="btn btn-info" onclick="">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            <select class="form-control" id="id_fase">
                                <option value="0" selected> Seleccione</option>
                                @foreach($fases as $fase)
                                    <option value="{{$fase->id}}" onclick="traerFases({{$fase->id}})">{{$fase->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="">Modulo</label>
                            <select class="form-control" id="id_modulo">

                            </select>
                        </div>
                        <a href="" class="btn btn-info" onclick="">
                            <i class="fas fa-file-signature"></i>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4">
                            <label for="">Actividad</label>
                            <select class="form-control" id="id_actividad">

                            </select>
                        </div>
                    </div>
                    <a href="" class="btn btn-info" onclick="">
                        <i class="fas fa-file-signature"></i>
                    </a>
                    <br>
            </div>

        </div>
    </div>
  </div>
@endsection

@section('modals')
    
@endsection

@section('custom_scripts')
    <script src="{{URL::asset('JS/AJAX/alumno/historiasFormAgil.js')}}"></script>
@endsection