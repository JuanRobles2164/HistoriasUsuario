var ctx = document.getElementById('estados_historias_grafica').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['inicial'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 0, 1)', 'rgb(99,178,15)'],
            borderColor: ['rgb(255, 99, 132)', 'rgb(255, 0, 1)'],
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
            chart.data.labels = response.labels;
            chart.data.datasets.data = [10];
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
}, 1000);