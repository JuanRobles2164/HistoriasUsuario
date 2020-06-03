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

  agregarFaseRapido = (Identificador) => {

    let nombre_fase = $('#nombre_fase_modal').val();
    let descripcion_fase = $('#descripcion_fase_modal').val();
    let fecha_limite = $('#fecha_limite_fase_modal').val();
    let fecha_inicio = $('#fecha_inicio_fase_modal').val();
    console.log(nombre_fase,descripcion_fase,fecha_limite,fecha_inicio,Identificador);
    const uri = $('#api_route_crear_fase').val();
    $.ajax({
        url: uri,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            'id_proyecto': Identificador, 
            'nombre':nombre_fase, 
            'descripcion':descripcion_fase, 
            'fecha_limite':fecha_limite,
            'fecha_inicio':fecha_inicio
        },
        success: function(response){
            //response = $.parseJSON(response);
            console.log(response)
            $('#id_fase').append("<option value='"+response.id+"' onclick='traerActividades("+response.id+")' selected> "+response.nombre+"</option>");
            alert('Creada satisfactoriamente');
            $('#modalfases').modal('hide');
            $('#nombre_fase_modal').val('');
            $('#descripcion_fase_modal').val('');
            $('#fecha_limite_fase_modal').val('');
            $('#fecha_inicio_fase_modal').val('');
        },
        error: function(response){
            console.log("Error: \n");
            console.log(response);
        }
    });
}
agregarModuloRapido = () => {

  let nombre_modulo = $('#nombre_modulo_modal').val();
  let descripcion_modulo = $('#descripcion_modulo_modal').val();
  let fecha_limite = $('#fecha_limite_modulo_modal').val();
  let fecha_inicio = $('#fecha_inicio_modulo_modal').val();
  console.log(nombre_modulo,descripcion_modulo,fecha_limite,fecha_inicio,$('#id_fase').val());
  const uri = $('#api_route_crear_modulo').val();
  if($('#id_fase').val()!=0){
    $.ajax({
      url: uri,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
          'id_fase': $('#id_fase').val(), 
          'nombre':nombre_modulo, 
          'descripcion':descripcion_modulo,
          'fecha_limite':fecha_limite,
          'fecha_inicio':fecha_inicio
      },
      success: function(response){
          //response = $.parseJSON(response);
          console.log(response)
          $('#id_modulo').append("<option value='"+response.id+"' onclick='traerActividades("+response.id+")' selected> "+response.nombre+"</option>");
          alert('Creada satisfactoriamente');
          $('#modalmodulos').modal('hide');
          $('#nombre_modulo_modal').val('');
          $('#descripcion_modulo_modal').val('');
          $('#fecha_limite_modulo_modal').val('');
          $('#fecha_inicio_modulo_modal').val('');
      },
      error: function(response){
          console.log("Error: \n");
          console.log(response);
      }
    });
  }else{
    alert('Debe seleccionar una fase primero!')
  }
}
agregarModuloRapido = () => {

  let nombre_actividad = $('#nombre_actividad_modal').val();
  let descripcion_actividad = $('#descripcion_actividad_modal').val();
  let fecha_limite = $('#fecha_limite_actividad_modal').val();
  let fecha_inicio = $('#fecha_inicio_actividad_modal').val();
  console.log(nombre_actividad,descripcion_actividad,fecha_limite,fecha_inicio,$('#id_fase').val());
  const uri = $('#api_route_crear_actividad').val();
  if($('#id_modulo').val()!=0){
    $.ajax({
      url: uri,
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
          'id_fase': $('#id_modulo').val(), 
          'nombre':nombre_actividad, 
          'descripcion':descripcion_actividad,
          'fecha_limite':fecha_limite,
          'fecha_inicio':fecha_inicio
      },
      success: function(response){
          //response = $.parseJSON(response);
          console.log(response)
          $('#id_actividad').append("<option value='"+response.id+"' onclick='traerActividades("+response.id+")' selected> "+response.nombre+"</option>");
          alert('Creada satisfactoriamente');
          $('#modalactividades').modal('hide');
          $('#nombre_actividad_modal').val('');
          $('#descripcion_actividad_modal').val('');
          $('#fecha_limite_actividad_modal').val('');
          $('#fecha_inicio_actividad_modal').val('');
      },
      error: function(response){
          console.log("Error: \n");
          console.log(response);
      }
    });
  }else{
    alert('Debe seleccionar un modulo primero!')
  }
}

$('#desplazamiento_bar').on('mousemove',function(){
  let valor = $('#desplazamiento_bar').val();
  switch(valor){
    case "1":
      $("#indicador_prioridad").attr('class', 'alert alert-light');
      $("#indicador_prioridad").text("Muy baja");
      break;
    case "2":
      $("#indicador_prioridad").attr('class', 'alert alert-dark');
      $("#indicador_prioridad").text("Baja");
      break;
    case "3":
      $("#indicador_prioridad").attr('class', 'alert alert-info');
      $("#indicador_prioridad").text("Media");
      break;
    case "4":
      $("#indicador_prioridad").attr('class', 'alert alert-warning');
      $("#indicador_prioridad").text("Alta");
      break;
    default:
      $("#indicador_prioridad").attr('class', 'alert alert-danger');
      $("#indicador_prioridad").text("Muy alta");
      break;
  }
});