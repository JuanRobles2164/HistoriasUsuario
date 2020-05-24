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
  $('#btnCierraModal').click(function(){
    limpiarModal();
  });
  function limpiarSelect(){
    $('#tipo_recurso_modal option').empty();
  }


consultandoRecurso = (Indetificador) =>{
    const ruta = $('#api_route_get_recurso').val();
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {id_proyecto:Indetificador, id_fase:Indetificador, id_modulo:Indetificador, id_actividad:Indetificador, id_recurso:Indetificador, legal:true},
      success: function(response){
        response = $.parseJSON(response);
        console.log(response.recurso);
        $('#id_proyecto_modal').val(response.id_proyecto);
        $('#id_fase_modal').val(response.id_fase);
        $('#id_modulo_modal').val(response.id_modulo);
        $('#id_actividad_modal').val(response.id_actividad);
        $('#id_recurso_modal').val(response.recurso.id);
        $('#nombre_recurso_modal').val(response.recurso.nombre);
        $('#descripcion_recurso_modal').val(response.recurso.descripcion);
        $('#cantidad_recurso_modal').val(response.recurso.cantidad);
        $('#valor_unitario_recurso_modal').val(response.recurso.valor_unitario);
        lista_tipos_recurso = response.tipos_recursos;
        lista_tipos_recurso.forEach(element => {
          $('#tipo_recurso_modal').append('<option value="'+element.id + '">'+element.nombre +'</option>');
        });
      },
      error: function(response){
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }
  
  

editarRecurso = () => {
    const ruta = $('#web_editar_recurso').val();
    let id_recurso = $('#id_recurso_modal').val();
    let nombre_recurso = $('#nombre_recurso_modal').val();
    let descripcion_recurso = $('#descripcion_recurso_modal').val();
    let cantidad_recurso = $('#cantidad_recurso_modal').val();
    let valor_unitario_recurso = $('#valor_unitario_recurso_modal').val();
    let tipo_recurso = $('#tipo_recurso_modal').val();
    $.ajax({
      type: 'GET',
      url: ruta,
      async: true,
      data:{
        'id':id_recurso,
        'nombre':nombre_recurso,
        'descripcion':descripcion_recurso,
        'cantidad':cantidad_recurso,
        'valor_unitario':valor_unitario_recurso,
        'id_tipo_recurso':tipo_recurso
      },
      success: function(response){
        console.log(response);
        alert('Actualización Existosa');
        limpiarModal();
        
        limpiarSelect();
        $('#modalEditarRecurso').modal('hide');
        location.reload();
      },
      error: function(response){
        console.log(response);
      }
    });
  }