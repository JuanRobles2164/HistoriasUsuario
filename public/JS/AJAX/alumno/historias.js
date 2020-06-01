$('#btnAgregarCompromiso').on('click', function(e){
    e.preventDefault();
    $('#contenedor').append( "<tr><td><textarea type='text' class='form-control' name='compromisos[]'></textarea></td></tr>" );
})
  
  $('#btn_agregar_evidencia').on('click', function(e){
    e.preventDefault();
    $('#contenedor_evidencia').append( "<tr><td><input type='text' class='form-control' name='nombre_evidencia[]'></td><td><input type='file' class='form-control-file' name='foto_evidencia[]'></td></tr>" );
  });
  
  $('btn_editar_modal').click(function(event){
    event.preventDefault();
  });