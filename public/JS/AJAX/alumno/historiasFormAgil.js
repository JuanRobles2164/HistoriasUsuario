traerFases = (fase) => {
    $('#id_modulo').empty();
    $('#id_modulo').append("<option value='0' selected> Seleccione</option>");
    $('#id_actividad').empty();
    $('#id_actividad').append("<option value='0' selected> Seleccione</option>");
    const ruta = $('#api_route_get_modulos').val();
      if($('#id_fase').val() != 0){
        $.ajax({
          url: ruta,
          type: 'GET',
          async: true,
          data: {'id_fase': fase, 'legal':true},
          success: function(response){
            console.log(response);
            response.forEach(element => {
              $('#id_modulo').append("<option value='"+element.id+"' onclick='traerActividades("+element.id+")'> "+element.nombre+"</option>");
            });
          },
          error: function(response){
            console.log(response);
            alert("Algo salió mal... vuelve a intentarlo");
            response = null;
          }
        });
      }
  }

      
  traerActividades = (modulo) =>{
    
    const ruta = $('#api_route_get_actividades').val();
    console.log("funciona!");
    if($('#id_fase').val() != 0){
      $.ajax({
        url: ruta,
        type: 'GET',
        async: true,
        data: {'id_modulo':modulo, 'legal':true},
        success: function(response){
          console.log(response);
          response.forEach(element => {
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
  }