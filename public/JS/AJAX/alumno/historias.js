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

  $('document').ready(function(){
    $('#id_fase').change(function(){
      alert('xd');
      const ruta = $('#api_route_get_modulos').val();
      var fase = $('#id_fase').val();
      console.log(ruta);
      if($('#id_fase').val()!=0){
        $.ajax({
          url: ruta,
          type: 'GET',
          async: true,
          data: {'id_fase': fase, 'legal':true},
          success: function(response){
            console.log(response);
            response.forEach(element => {
              $('#id_modulo').empty();
              $('#id_modulo').append("<option value'"+element.id+"'> "+element.nombre+"</option>");
            });
          },
          error: function(response){
            console.log(response);
            alert("Algo salió mal... vuelve a intentarlo");
            response = null;
          }
        });
      }
    });
  });
      
  traerActividades = (Identificador) =>{
    const ruta = $('#api_route_get_actividades').val();
    console.log(ruta);
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {'id_modulo':Identificador, 'legal':true},
      success: function(response){
        response.forEach(element => {
          $('#id_actividad').empty();
          $('#id_actividad').append("<option value'"+element.id+"'> "+element.nombre+"</option>");
        });
      },
      error: function(response){
        console.log(response);
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
}