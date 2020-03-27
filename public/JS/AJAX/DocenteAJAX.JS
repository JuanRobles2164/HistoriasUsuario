function agregarFuenteMetodologia(){
    let url_fuente = $('#url_fuente').val();
    let descripcion_fuente = $('#descripcion_fuente').val();
    let id_metodologia = $('#id_metodologia').val();
    $.ajax({
        url : 'agregar_fuente_metodologia',
        async : true,
        data: {url_fuente:url_fuente, descripcion_fuente:descripcion_fuente, id_metodologia:id_metodologia},
        success: function(response){
            let info = $.parseJSON(response);
            //Limpia el contenido de "No hay fuentes"
            $("#td_url_no_element").remove();
            $("#td_descripcion_no_element").remove();
            $("#btnSectionFuente").remove();

            //Pushea a la tabla el contenido
            $("#tr_no_elements").append("<td scope=row valign=middle align=center>"+info.url+"</td>");
            $("#tr_no_elements").append("<td scope=row valign=middle align=center>"+info.descripcion+"</td>");
            let botonera = "<td scope=row valign=middle align=center><a href=/docente/eliminar_fuente_metodologia?id="+info.id+" class=btn btn-warning id=btnEditarFuente>Editar</a></td>";
            $("#tr_no_elements").append(botonera);
            //$("#tr_no_elements").append("");
        },
        error: function(response){
            alert("Error al traer los datos, inténtelo más tarde");
        }
    });
}
