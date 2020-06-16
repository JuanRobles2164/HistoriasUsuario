var ctx = document.getElementById('estados_historias_grafica').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['inicial'],
        datasets: [{
            label: 'Estado de las historias',
            backgroundColor: [
                '#00D8FF',
                '#DD1B16',
                '#41B883'
            ],
            data: []
        }]
    },
    // Configuration options go here
    options: {}
});

const updateGraficaEstadoHistorias = () => {
    const ruta = $('#api_route_get_historias_graficas').val();
    $.ajax({
        url: ruta,
        type: 'GET',
        data: null,
        success: function(response){
            console.log(response);
            const arrayLabels = [];
            const arrayCount = [];
            response.labels.forEach(element => {
                arrayLabels.push(element.estado);
            });
            response.contador.forEach(element => {
                arrayCount.push(element);
            });
            console.log(arrayCount);
            chart.data.labels = arrayLabels;
            chart.data.datasets[0].data = arrayCount;
            chart.update();
        },
        error: function(response){
            console.log(response);
        }
    });
}


updateGraficaEstadoHistorias();

setInterval(() => {
    updateGraficaEstadoHistorias()
}, 2500);

