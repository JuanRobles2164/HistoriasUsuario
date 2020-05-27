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
            $('#validationDefault05').append("<option value='"+response.id+"' selected>"+response.descripcion+"</option>");
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