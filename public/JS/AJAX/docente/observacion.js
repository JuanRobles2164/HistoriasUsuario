limpiarModal = () => {
    $('#observacion_grupo').val('');
    $('#id_grupo_observacion').val('');
  }
  
  $('#btnCierraModal').click(function(){
    limpiarModal();
  });

consultaGrupo = (Identificador) =>{
    const ruta = $('#api_route_get_observacion').val();
    console.log(ruta);
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {'id_grupo':Identificador, 'legal':true},
      success: function(response){
        //response = $.parseJSON(response);
        console.log(response);
        $('#nombre_grupo').text(response.nombre);
        $('#id_grupo_observacion').val(response.id);
      },
      error: function(response){
        console.log(response);
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }
  
  

crearObservacion = () => {
    const ruta = $('#web_crear_observacion').val();
    let id_grupo = $('#id_grupo_observacion').val();
    let comentario = $('#observacion_grupo').val();
    $.ajax({
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: ruta,
      async: true,
      data:{
        'id_grupo':id_grupo,
        'comentario':comentario
      },
      success: function(response){
        console.log(response);
        alert('Creacion Existosa');
        limpiarModal();

        $('#modalComentario').modal('hide');
        location.reload();
      },
      error: function(response){
        console.log(response);
      }
    });
  }

