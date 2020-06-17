consultandogrupos = (Identificador) =>{
    const uri = $('#api_route_get_grupo').val();
    $.ajax({
      url: uri,
      async: true,
      data: {'id_grupo':Identificador},
      success:function(response){
        console.log(response);
        $('#modal_nombre_grupo').val(response.nombre);
        $('#descripcion_grupo').val(response.descripcion);

  
        $('#modal_nombre_grupo').attr('disabled','disabled');
        $('#descripcion_grupo').attr('disabled','disabled');

        $('#modalgrupos').modal('show');
      },
      error:function(error){
        console.log("ERROR:\n");
        console.log(error);
        $('#nombre_grupo').val('Error al consultar, intente más tarde');
      }
    });
  }
  
  $('#btnCierramodal').click(function(){
    $('#modalgrupos').toggle();
  });

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