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
  $('#contenedor').append( "<tr><td><textarea type='text' name='compromisos[]'></textarea></td></tr>" );
})

$('#btn_agregar_evidencia').on('click', function(e){
  e.preventDefault();
  $('#contenedor_evidencia').append( "<tr><td><input type='text' name='nombre_evidencia[]'></td><td><input type='file' name='foto_evidencia[]'></td></tr>" );
});

consultarFase = (id) => {
  $.ajax({
    url : window.location+'/get_editar_fase',
    async: true,
    data: {'id_fase':id},
    success: function(response){
      $('#id_fase_modal').val(response.id);
      $('#nombre_fase_modal').val(response.nombre);
      $('#descripcion_fase_modal').val(response.descripcion);
      $('#fecha_limite_fase_modal').val(response.fecha_limite);
    },
    error: function(response){
      alert("Algo salió mal... vuelve a intentarlo");
    }
  });
}

editarFase = () => {
  //Prepare data
  let id_fase = $('#id_fase_modal').val();
  let nombre_fase = $('#nombre_fase_modal').val();
  let descripcion_fase = $('#descripcion_fase_modal').val();
  let fecha_limite = $('#fecha_limite_fase_modal').val();
  let _token = $('#token_maestro').val();
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
    },
    error: function(response){
      console.log(response);
    }
  });
}