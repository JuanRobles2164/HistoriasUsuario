metodologiaData = (identificador) => {
    $('#modalMetodologia').modal('show');
    const uri = $('#api_route_get_fuentes').val();
    $.ajax({
        type: 'GET',
        async: true,
        url: uri,
        data: {
            'id_metodologia': identificador,
            'legal': true
        },
        success: function(response){
            console.log(response);
            response.forEach(element => {
            let cadena = "<tr>";
                cadena += "<td>";
                const ur = new URL(element.url);
                cadena += "<a href='"+element.url+"'>";
                cadena += ur.hostname;
                cadena += "</a>";
                cadena += "</td>";
                
                cadena += "<td>";
                cadena += element.descripcion;
                cadena += "</td>";

                cadena += "</tr>";
                $('#metodologia_fuentes').append(cadena);
            });
        },
        error: function(response){
            console.log("Error\n");
            console.log(response);
        }
    })
}