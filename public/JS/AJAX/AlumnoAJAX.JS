$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



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

