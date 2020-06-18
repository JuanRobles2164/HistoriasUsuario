agregarMetodologiaRapido = () => {
    const nombre = $('#nombre_metodologia').val();
    const descripcion = $('#descripcion_metodologia').val();
    const url = $('#fuente_metodologia').val();
    const descripcion_fuente = $('#descripcion_fuente').val();

    const uri = $('#api_route_crear_metodologia').val();
    $.ajax({
        url: uri,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            'nombre': nombre,
            'descripcion': descripcion, 
            'url': url,
            'descripcion_fuente': descripcion_fuente
        },
        success: function(response){
            //response = $.parseJSON(response);
            $('#validationDefault05').append("<option value='"+response.id+"' selected>"+response.nombre+"</option>");
            alert('Creada satisfactoriamente');
            $('#exampleModalCenter').modal('hide');
            $('#nombre_metodologia').val('');
            $('#descripcion_metodologia').val('');
            $('#fuente_metodologia').val('');
            $('#descripcion_fuente').val('');
        },
        error: function(response){
            console.log("Error: \n");
            console.log(response);
        }
    });
}
limpiarModal = () => {
      $('#obser tbody').empty();
  }
consultarObs = (Identificador) =>{
    const ruta = $('#api_route_get_observacion').val();
    console.log(ruta);
    console.log(Identificador);
    $.ajax({
      url: ruta,
      type: 'GET',
      async: true,
      data: {'id_proyecto':Identificador, 'legal':true},
      success: function(response){
        //response = $.parseJSON(response);
        console.log(response);
        Observaciones = response.obs;
        var island_serverinfo = '';
        Observaciones.forEach(element => {
            island_serverinfo += '<tr>';
            //island_serverinfo += '<input type="hidden" name="id_observacion" id="id_observacion" value="'+element.id_observacion+'">';
            island_serverinfo += '<td scope="row">'+element.observacion+'</td>';
            island_serverinfo += '<td scope="row">'+element.created_at+'</td>';       
            island_serverinfo += '<td scope="row">'+element.usuariov+'</td>';
            island_serverinfo += '</tr>';
        });
        $('#obser tbody').append(island_serverinfo);
      },
      error: function(response){
        console.log(response);
        alert("Algo salió mal... vuelve a intentarlo");
        response = null;
      }
    });
  }