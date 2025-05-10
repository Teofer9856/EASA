const ctx = document.getElementById('myChart');

Chart.defaults.font.size= 14;
Chart.defaults.font.family= "'Roboto', sans-serif";
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Clients', 'Products', 'Sellers', 'Sales'],
        datasets: [{
            label: 'Nº Last Month',
            data: JSON.parse(ctx.getAttribute('data-chart')),
            borderWidth: 1,
            backgroundColor: [
            'rgba(32, 77, 237, 0.38)',
            'rgba(237, 171, 32, 0.38)',
            'rgba(237, 32, 32, 0.38)',
            'rgba(149, 32, 237, 0.38)'
            ],

            /* backgroundColor: '#dee2e6', */
            borderColor: 'black'
        }]
    },
    options: {
    layout: {
        padding: {
            left: 15,
            right: 15,
            bottom: 10
        }
    },
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
        beginAtZero: true
        }
    },
    plugins: {
        legend: {
            labels: {
                font: {
                    size: 13,
                }
            }
        }
    },
}
})
