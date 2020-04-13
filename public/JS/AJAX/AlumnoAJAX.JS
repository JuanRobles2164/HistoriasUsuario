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