consultarHistoria = (Identificador) => {
    const ruta = $('#api_route_get_historia').val();
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: { 'id_historia': Identificador, 'legal': true},
      success: function(response){
        console.log(response);
      },
      error: function(response){
        console.log(response);
      }
    });
}

consultarFase = (Identificador) => {
    const ruta = $('#api_route_get_fase').val();
    $.ajax({
      url : ruta,
      type: 'GET',
      async: true,
      data: {id_fase:Identificador, legal:true},
      success: function(response){
        console.log(response);
        response = $.parseJSON(response);
        $('#nombreFaseModal').text(response.nombre);
        $('#descripcionFaseModal').text(response.descripcion);
      },
      error: function(response){
        alert("Algo salió mal... vuelve a intentarlo");
        console.log(response);
      }
    });
  }

  consultandometodologia = (Identificador) =>{
    $.ajax({
        url: 'detalles_metodologia',
        async: true,
        data: {id:Identificador},
        success:function(response){
            //let data = $.parseJSON(response);
            $('#nombre_metodologia').val(response.nombre);
            $('#descripcion_metodologia').val(response.descripcion);
            
            $('#nombre_metodologia').attr('disabled','disabled');
            $('#descripcion_metodologia').attr('disabled','disabled');

            $('#modalmetodologia').modal('show');
            console.log(response);
        },
        error:function(error){
            console.log(error);
            $('#nombre_metodologia').val('Error al consultar, intente más tarde');
            $('#modalmetodologia').show();
        }

    });
}

consultandoproyectos = (Identificador) =>{
  $.ajax({
    url: 'detalles_proyectos',
    async: true,
    data: {id:Identificador},
    success:function(response){
      console.log(response);
      /*$('#nombre_proyecto').val(response[0].nombre);
      $('#descripcion_proyecto').val(response[0].descripcion);
      $('#fecha_inicio_proyecto').val(response[0].fecha_inicial);
      $('#fecha_fin_proyecto').val(response[0].fecha_limite);
      $('#metodologia_proyecto').val(response[1].nombre);*/
      $('#nombre_proyecto').val(response.proyecto.nombre);
      $('#descripcion_proyecto').val(response.proyecto.descripcion);
      $('#fecha_inicio_proyecto').val(response.proyecto.fecha_inicial);
      $('#fecha_fin_proyecto').val(response.proyecto.fecha_limite);
      $('#metodologia_proyecto').val(response.metodologia.nombre);

      $('#nombre_proyecto').attr('disabled','disabled');
      $('#descripcion_proyecto').attr('disabled','disabled');
      $('#fecha_inicio_proyecto').attr('disabled','disabled');
      $('#fecha_fin_proyecto').attr('disabled','disabled');
      $('#metodologia_proyecto').attr('disabled','disabled');

      $('#modalproyectos').modal('show');
    },
    error:function(error){
      console.log(error);
      $('#nombre_proyecto').val('Error al consultar, intente más tarde');
    }
  });
}


$('#btnCierramodalmetodologia').click(function(){
  $('#modalDetalles').toggle();
  $('#modalproyectos').toggle();
});