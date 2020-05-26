limpiarModal = () => {
    $('#observacion_grupo').val('');
    $('#id_grupo_observacion').val('');
  }
  
  $('#btnCierraModal').click(function(){
    limpiarModal();
  });

consultaGrupo = (Identificador, Identificador2) =>{
    const ruta = $('#api_route_get_observacion').val();
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {id_proyecto:Identificador, id_grupo:Identificador2, legal:true},
      success: function(response){
        response = $.parseJSON(response); 
        console.log(response.grupo);
        $('#nombre_grupo').val(response.grupo);
        $('#id_grupo_observacion').val(response.id_grupo);
      },
      error: function(response){
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }
  
  

crearObservacion = () => {
    const ruta = $('#web_crear_observacion').val();
    let id_grupo = $('#id_grupo_observacion').val();
    let observacion = $('#observacion_grupo').val();
    $.ajax({
      type: 'POST',
      url: ruta,
      async: true,
      data:{
        'id_grupo':id_grupo,
        'observacion':observacion
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