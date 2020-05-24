$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('#desplazamiento_bar').on('mousemove',function(){
    let valor = $('#desplazamiento_bar').val();
    switch(valor){
      case "1":
        $("#indicador_prioridad").attr('class', 'alert alert-light');
        $("#indicador_prioridad").text("Muy baja");
        break;
      case "2":
        $("#indicador_prioridad").attr('class', 'alert alert-dark');
        $("#indicador_prioridad").text("Baja");
        break;
      case "3":
        $("#indicador_prioridad").attr('class', 'alert alert-info');
        $("#indicador_prioridad").text("Media");
        break;
      case "4":
        $("#indicador_prioridad").attr('class', 'alert alert-warning');
        $("#indicador_prioridad").text("Alta");
        break;
      default:
        $("#indicador_prioridad").attr('class', 'alert alert-danger');
        $("#indicador_prioridad").text("Muy alta");
        break;
    }
});
$('#crear_usuario_entrevistado').on('click', function(e){
  e.preventDefault();
  let nombre = $("input[name=nombre_usuario_entrevistado]").val();
  let email = $("input[name=email_usuario_entrevistado]").val();
  let telefono = $("input[name=telefono_usuario_entrevistado]").val();
  let cargo = $("input[name=cargo_usuario_entrevistado]").val();
  /*$.ajax({
    url : 'crear_usuario_entrevistado',
    async : true,
    data: {'nombre':nombre, 'email':email, 'telefono':telefono, 'cargo':cargo},
    success: function(response){
      alert('¡Creado correctamente!' + response);
    },
    error: function(response){
      alert('Error al insertar: ' + response);
    }
  });*/
});

$('#btnAgregarCompromiso').on('click', function(e){
  e.preventDefault();
  $('#contenedor').append( "<tr><td><textarea type='text' class='form-control' name='compromisos[]'></textarea></td></tr>" );
})

$('#btn_agregar_evidencia').on('click', function(e){
  e.preventDefault();
  $('#contenedor_evidencia').append( "<tr><td><input type='text' class='form-control' name='nombre_evidencia[]'></td><td><input type='file' class='form-control-file' name='foto_evidencia[]'></td></tr>" );
});

$('btn_editar_modal').click(function(event){
  event.preventDefault();
});

limpiarModal = () => {
  $('#id_fase_modal').val('');
  $('#nombre_fase_modal').val('');
  $('#descripcion_fase_modal').val('');
  $('#fecha_limite_fase_modal').val('');
  $('#id_proyecto_modal').val('');
  $('#id_fase_modal').val('');
  $('#id_modulo_modal').val('');
  $('#nombre_modulo_modal').val('');
  $('#descripcion_modulo_modal').val('');
  $('#fecha_limite_modulo_modal').val('');
  $('#id_proyecto_modal').val('');
  $('#id_fase_modal').val('');
  $('#id_modulo_modal').val('');
  $('#id_actividad_modal').val('');
  $('#id_recurso_modal').val('');
  $('#nombre_recurso_modal').val('');
  $('#descripcion_recurso_modal').val('');
  $('#cantidad_recurso_modal').val('');
  $('#valor_unitario_recurso_modal').val('');

}

consultarFase = (Identificador) => {
  const ruta = $('#api_route_get_fase').val();
  console.log(ruta);
  $.ajax({
    url : ruta,
    type: 'GET',
    async: true,
    data: {id_fase:Identificador, legal:true},
    success: function(response){
      console.log(response);
      response = $.parseJSON(response);
      $('#id_fase_modal').val(response.id);
      $('#nombre_fase_modal').val(response.nombre);
      $('#descripcion_fase_modal').val(response.descripcion);
      $('#fecha_limite_fase_modal').val(response.fecha_limite);
    },
    error: function(response){
      alert("Algo salió mal... vuelve a intentarlo");
      response = null;
    }
  });
}

$('#btnCierraModal').click(function(){
  limpiarModal();
});

editarFase = () => {
  //Prepare data
  let id_fase = $('#id_fase_modal').val();
  let nombre_fase = $('#nombre_fase_modal').val();
  let descripcion_fase = $('#descripcion_fase_modal').val();
  let fecha_limite = $('#fecha_limite_fase_modal').val();
  $.ajax({
    //A toda petición de POST hay que generarle un _token
    //Nunca lo olviden!
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    url : window.location+'/post_editar_fase',
    async: true,
    data: 
    {
    'id':id_fase, 
    'nombre':nombre_fase, 
    'descripcion':descripcion_fase, 
    'fecha_limite':fecha_limite,
    'eliminar_imagen': true
    },
    success: function(response){
      alert('Actualización exitosa');
      limpiarModal();
      response = null;
    },
    error: function(response){
      console.log(response);
      response = null;
    }
  });
}

consultarModulo = (Identificador) => {
  const ruta = $('#api_route_get_modulo').val();
  $.ajax({
    url : ruta,
    type: 'GET',
    async: true,
    data: {id_proyecto:Identificador, id_fase:Identificador, id_modulo:Identificador, legal:true},
    success: function(response){
      console.log(response);
      response = $.parseJSON(response);
      $('#id_proyecto_modal').val(response.id);
      $('#id_fase_modal').val(response.id);
      $('#id_modulo_modal').val(response.id);
      $('#nombre_modulo_modal').val(response.nombre);
      $('#descripcion_modulo_modal').val(response.descripcion);
      $('#fecha_limite_modulo_modal').val(response.fecha_limite);
    },
    error: function(response){
      alert("Algo salió mal... vuelve a intentarlo");
      response = null;
    }
  });
}

$('#btnCierraModal').click(function(){
  limpiarModal();
});

editarModulo = () => {
  const ruta = $('#web_editar_modulo').val();
  let id_modulo = $('#id_modulo_modal').val();
  let nombre_modulo = $('#nombre_modulo_modal').val();
  let descripcion_modulo = $('#descripcion_modulo_modal').val();
  let fecha_limite = $('#fecha_limite_modulo_modal').val();
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'POST',
    url: ruta,
    async: true,
    data:{
      'id':id_modulo,
      'nombre':nombre_modulo,
      'descripcion':descripcion_modulo,
      'fecha_limite':fecha_limite
    },
    success: function(response){
      console.log(response);
      alert('Actualización Existosa');
      limpiarModal();
      response = null;
    },
    error: function(response){
      console.log(response);
      response = null;
    }
  });
}

var lista_tipos_recurso = null;

function limpiarSelect(){
  const elementos = document.querySelectorAll('#tipo_recurso_modal option');
      elementos.forEach((elemento, i)=> {
        elemento.parentNode.removeChild(elemento);
  })
}

consultandoRecurso = (Indetificador) =>{
  const ruta = $('#api_route_get_recurso').val();
  $.ajax({
    url: ruta,
    type: 'GET',
    async: true,
    data: {id_proyecto:Indetificador, id_fase:Indetificador, id_modulo:Indetificador, id_actividad:Indetificador, id_recurso:Indetificador, legal:true},
    success: function(response){
      response = $.parseJSON(response);
      console.log(response.recurso);
      $('#id_proyecto_modal').val(response.id_proyecto);
      $('#id_fase_modal').val(response.id_fase);
      $('#id_modulo_modal').val(response.id_modulo);
      $('#id_actividad_modal').val(response.id_actividad);
      $('#id_recurso_modal').val(response.recurso.id);
      $('#nombre_recurso_modal').val(response.recurso.nombre);
      $('#descripcion_recurso_modal').val(response.recurso.descripcion);
      $('#cantidad_recurso_modal').val(response.recurso.cantidad);
      $('#valor_unitario_recurso_modal').val(response.recurso.valor_unitario);
      lista_tipos_recurso = response.tipos_recursos;
      lista_tipos_recurso.forEach(element => {
        $('#tipo_recurso_modal').append('<option value="'+element.id + '">'+element.nombre +'</option>');
      });
    },
    error: function(response){
      alert("Algo salió mal... vuelve a intentarlo");
      response = null;
    }
  });
}

editarRecurso = () => {
  const ruta = $('#web_editar_recurso').val();
  let id_recurso = $('#id_recurso_modal').val();
  let nombre_recurso = $('#nombre_recurso_modal').val();
  let descripcion_recurso = $('#descripcion_recurso_modal').val();
  let cantidad_recurso = $('#cantidad_recurso_modal').val();
  let valor_unitario_recurso = $('#valor_unitario_recurso_modal').val();
  let tipo_recurso = $('#tipo_recurso_modal').val();
  $.ajax({
    type: 'GET',
    url: ruta,
    async: true,
    data:{
      'id':id_recurso,
      'nombre':nombre_recurso,
      'descripcion':descripcion_recurso,
      'cantidad':cantidad_recurso,
      'valor_unitario':valor_unitario_recurso,
      'id_tipo_recurso':tipo_recurso
    },
    success: function(response){
      console.log(response);
      alert('Actualización Existosa');
      limpiarModal();
      limpiarSelect();
      $('#modalEditarRecurso').modal('hide');
      location.reload();
    },
    error: function(response){
      console.log(response);
    }
  });
}