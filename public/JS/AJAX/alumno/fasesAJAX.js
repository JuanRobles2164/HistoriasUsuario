consultarFase = (Identificador) => {
  const ruta = $('#api_route_get_fase').val();
  console.log(ruta);
  $.ajax({
    url : ruta,
    type: 'GET',
    async: true,
    data: {id_fase:Identificador, legal:true},
    success: function(response){
      console.log(response);
      response = $.parseJSON(response);
      $('#id_fase_modal').val(response.id);
      $('#nombre_fase_modal').val(response.nombre);
      $('#descripcion_fase_modal').val(response.descripcion);
      $('#fecha_limite_fase_modal').val(response.fecha_limite);
    },
    error: function(response){
      alert("Algo salió mal... vuelve a intentarlo");
      response = null;
    }
  });
}

editarFase = () => {
    //Prepare data
    let id_fase = $('#id_fase_modal').val();
    let nombre_fase = $('#nombre_fase_modal').val();
    let descripcion_fase = $('#descripcion_fase_modal').val();
    let fecha_limite = $('#fecha_limite_fase_modal').val();
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
        limpiarModal();
        response = null;
      },
      error: function(response){
        console.log(response);
        response = null;
      }
    });
  }
