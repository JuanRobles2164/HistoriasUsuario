function agregarFuenteMetodologia(){
    window.location = "agregar_fuente_metodologia?id_metodologia="+$('#id_metodologia').val()+"&descripcion_fuente="+$('#descripcion_fuente').val()+"&url_fuente="+encodeURIComponent($('#url_fuente').val());
}