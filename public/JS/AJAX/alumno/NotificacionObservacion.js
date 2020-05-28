function limpiarModal(){
    $('#leidas').empty();
    $('#sinleer').empty();
}
  
  $('#btnCierraModal').click(function(){
    limpiarModal();
  });

consultarObservaciones = (Identificador) =>{
    const ruta = $('#api_route_get_notificacion').val();
    console.log(ruta);
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {'id_proyecto':Identificador, 'legal':true},
      success: function(response){
        //response = $.parseJSON(response);
        console.log(response.ObV);
        $('#id_usuario').val(response.usuario);
        $('#id_proyecto').val(Identificador);
        ObservacionesLeidas = response.ObV;
        ObservacionesSinleer = response.ObS;
        var island_serverinfo = '';
        ObservacionesSinleer.forEach(element => {
            island_serverinfo += '<tr>';
            island_serverinfo += '<input type="hidden" name="id_observacion" id="id_observacion" value="'+element.id_observacion+'">';
            island_serverinfo += '<td scope="row">'+element.observacion+'</td>';
            island_serverinfo += '<td scope="row"> <a class="btn btn-primary" onclick="marcarLeida()"></a> </td>';
            island_serverinfo += '</tr>';
        });
        $('#sinleer tbody').append(island_serverinfo);
        island_serverinfo = '';
        ObservacionesLeidas.forEach(element =>{
            island_serverinfo += '<tr>';
            island_serverinfo += '<td scope="row">'+element.observacion+'</td>';
            island_serverinfo += '<td scope="row">'+element.fecha+'</td>';
            island_serverinfo += '</tr>';
        });
        $('#leidas tbody').append(island_serverinfo);
      },
      error: function(response){
        console.log(response);
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }


  MarcarLeida =() => {
    const ruta = $('#web_observaciones').val();
    let id_usuario = $('#id_usuario').val();
    let id_observacion = $('#id_observacion').val();
    let id_proyecto = $('#id_proyecto').val();
    console.log(ruta);
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: ruta,
        async: true,
        data:{
          'id_usuario':id_usuario,
          'id_observacion':id_observacion,
        },
        success: function(response){
          console.log(response);
          alert('La observacion se marco como leida!');
          limpiarModal();
          consultaGrupo(id_proyecto);
        },
        error: function(response){
          console.log(response);
        }
    });
  }