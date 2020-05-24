limpiarModal = () => {
    $('#id_fase_modal').val('');
    $('#nombre_fase_modal').val('');
    $('#descripcion_fase_modal').val('');
    $('#fecha_limite_fase_modal').val('');
    $('#id_proyecto_modal').val('');
    $('#id_fase_modal').val('');
    $('#id_modulo_modal').val('');
    $('#nombre_modulo_modal').val('');
    $('#descripcion_modulo_modal').val('');
    $('#fecha_limite_modulo_modal').val('');
    $('#id_proyecto_modal').val('');
    $('#id_fase_modal').val('');
    $('#id_modulo_modal').val('');
    $('#id_actividad_modal').val('');
    $('#id_recurso_modal').val('');
    $('#nombre_recurso_modal').val('');
    $('#descripcion_recurso_modal').val('');
    $('#cantidad_recurso_modal').val('');
    $('#valor_unitario_recurso_modal').val('');
  
  }


  consultarModulo = (Identificador) => {
    const ruta = $('#api_route_get_modulo').val();
    $.ajax({
      url : ruta,
      type: 'GET',
      async: true,
      data: {id_proyecto:Identificador, id_fase:Identificador, id_modulo:Identificador, legal:true},
      success: function(response){
        console.log(response);
        response = $.parseJSON(response);
        $('#id_proyecto_modal').val(response.id);
        $('#id_fase_modal').val(response.id);
        $('#id_modulo_modal').val(response.id);
        $('#nombre_modulo_modal').val(response.nombre);
        $('#descripcion_modulo_modal').val(response.descripcion);
        $('#fecha_limite_modulo_modal').val(response.fecha_limite);
      },
      error: function(response){
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }



  editarModulo = () => {
    const ruta = $('#web_editar_modulo').val();
    let id_modulo = $('#id_modulo_modal').val();
    let nombre_modulo = $('#nombre_modulo_modal').val();
    let descripcion_modulo = $('#descripcion_modulo_modal').val();
    let fecha_limite = $('#fecha_limite_modulo_modal').val();
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'POST',
      url: ruta,
      async: true,
      data:{
        'id':id_modulo,
        'nombre':nombre_modulo,
        'descripcion':descripcion_modulo,
        'fecha_limite':fecha_limite
      },
      success: function(response){
        console.log(response);
        alert('Actualización Existosa');
        limpiarModal();
        response = null;
      },
      error: function(response){
        alert('Algo salió mal... comuníquese con soporte');
        console.log(response);
        response = null;
      }
    });
  }


