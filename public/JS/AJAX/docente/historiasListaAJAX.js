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