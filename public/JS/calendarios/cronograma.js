$(document).ready(function(){
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid' ],
      
    });

    calendar.render();
    const uri = $('#api_route_fill_calendar').val();
    $.ajax({
        url: uri,
        async: true,
        success: function(response){
            const fasesArray = response.fases;
            
            console.log(response);
            fasesArray.forEach(element => {
                let temporaryFaseEvent = {
                    title: element.nombre,
                    start: element.fecha_inicio,
                    end: element.fecha_limite,
                    color: 'rgb(134, 255, 51)'
                };
                calendar.addEvent(temporaryFaseEvent);
            });
            response.modulos.forEach(moduloMatrix => {
                moduloMatrix.forEach(element => {
                    let temporaryFaseEvent = {
                        title: element.nombre,
                        start: element.fecha_inicio,
                        end: element.fecha_limite,
                        color: 'rgb(255, 100, 51)'
                    };
                    calendar.addEvent(temporaryFaseEvent); 
                });
            });
            response.actividades.forEach(actividadMatrix => {
                actividadMatrix.forEach(element => {
                    let temporaryFaseEvent = {
                        title: element.nombre,
                        start: element.fecha_inicio,
                        end: element.fecha_limite,
                        color: 'rgb(51, 246, 255)'
                    };
                    calendar.addEvent(temporaryFaseEvent); 
                });
            });
        },
        error: function(response){
            console.log("error\n");
            console.log(response);
        }
    });
});