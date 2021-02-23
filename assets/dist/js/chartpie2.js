var ctx = document.getElementById('myChart3');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: ['Sembuh', 'Dirawat', 'Meninggal'],
        datasets: [{
            // label: 'Positif',
            backgroundColor: [
            'blue',
            'red',
            'green'
            ],
            borderColor: 'transparent',
            data: [123, 2012, 321]
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