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

$('#btnCierramodalmetodologia').click(function(){
  $('#modalDetalles').toggle();
});