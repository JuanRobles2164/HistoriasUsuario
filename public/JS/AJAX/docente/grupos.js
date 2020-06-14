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