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
        $('#fecha_inicio_modulo_modal').val(response.fecha_inicio);
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
    let fecha_inicio = $('#fecha_inicio_modulo_modal').val();
    let fase_fecha_limite = $('#fase_fecha_limite_modal').val();
    let fase_fecha_inicio = $('#fase_fecha_inicio_modal').val();
    console.log(fase_fecha_inicio, fase_fecha_limite);
    $.ajax({
      url: ruta,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      async: true,
      data:{
        'id':id_modulo,
        'nombre':nombre_modulo,
        'descripcion':descripcion_modulo,
        'fecha_inicio': fecha_inicio,
        'fecha_limite':fecha_limite,
        'fase_fecha_inicio' : fase_fecha_inicio,
        'fase_fecha_limite' : fase_fecha_limite
      },
      success: function(response){
        console.log(response);
        alert('Actualización Existosa');
        limpiarModal();
        $('#modalmodulo').hide();
        window.location.reload()
        response = null;
      },
      error: function(response){
        alert('Algo salió mal... comuníquese con soporte');
        console.log(response);
        response = null;
      }
    });
  }


