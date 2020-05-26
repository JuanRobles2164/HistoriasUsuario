@section('modals')
<input type="hidden" name="web_crear_observacion" id="web_crear_observacion" value="{{route('docente.postCrearObservacionGrupo')}}">
<div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Crear Observacion Grupo: 
              <label name="nombre_grupo" id="nombre_grupo"> </label>
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="id_grupo" id="id_grupo_observacion">
                <label for="observacion">Observacion</label>
                <textarea  class="form-control" name="observacion" id="observacion_grupo"></textarea>
                <br>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a type="submit" class="btn btn-primary" onclick="crearObservacion()">Crear</a>
                </div>
            </form>
      </div>
    </div>
  </div>
  @endsection