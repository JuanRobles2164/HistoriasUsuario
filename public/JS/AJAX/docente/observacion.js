limpiarModal = () => {
    $('#observacion_grupo').val('');
    $('#id_grupo_observacion').val('');
      $('#obser tbody').empty();
      $('#nombre_grupo_editar').val('');
      $('#descripcion_grupo_editar').val('');
      $('#id_grupo').val('');
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

  consultarObs = (Identificador) =>{
    const ruta = $('#api_route_get_notificacion').val();
    console.log(ruta);
    console.log(Identificador);
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {'id_grupo':Identificador, 'legal':true},
      success: function(response){
        //response = $.parseJSON(response);
        console.log(response);
        Observaciones = response.obs;
        var island_serverinfo = '';
        Observaciones.forEach(element => {
            island_serverinfo += '<tr>';
            //island_serverinfo += '<input type="hidden" name="id_observacion" id="id_observacion" value="'+element.id_observacion+'">';
            island_serverinfo += '<td scope="row">'+element.comentario+'</td>';
            island_serverinfo += '<td scope="row">'+element.created_at+'</td>';
            if(element.estado == 0){
              island_serverinfo += '<td scope="row">Sin ver</td>';
            }else{
              island_serverinfo += '<td scope="row">Vista</td>';
            }       
            if(element.usuariovisto == null){
              island_serverinfo += '<td scope="row"></td>';
            }else{
              island_serverinfo += '<td scope="row">'+element.usuariov+'</td>';
            }
            island_serverinfo += '</tr>';
        });
        $('#obser tbody').append(island_serverinfo);
      },
      error: function(response){
        console.log(response);
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }