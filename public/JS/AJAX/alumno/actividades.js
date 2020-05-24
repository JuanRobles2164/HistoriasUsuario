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