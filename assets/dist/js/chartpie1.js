var ctx = document.getElementById('myChart2');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: ['< 17', '17-40', '40 >'],
        datasets: [{
            // label: 'Positif',
            backgroundColor: [
            'red',
            'blue',
            'green'
            ],
            borderColor: '#transparent',
            data: [0, 2, 4]
        }]
    },

    // Configuration options go here
    options: {
    responsive: true,
    maintainAspectRatio: false,
        legend: {
        position: 'right'
        }   
    }
});