var ctx = document.getElementById('myChart1');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agust'],
        datasets: [{
            label: 'Positif',
            backgroundColor: 'transparent',
            borderColor: '#0041C2',
            data: [1, 2, 4, 5, 5, 5, 21, 22]
        }],
    },

    // Configuration options go here
    options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    },
    legend: {
        position: 'right'
}
}
});