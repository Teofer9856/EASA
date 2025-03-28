<x-app-layout>
    @push('links')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex-grow p-6 overflow-auto bg-gray-100">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-95 col-span-2 bg-white border rounded-lg border-gray-300">
                                    <canvas id="myChart"></canvas>
                            </div>
                            <div class="h-95 col-span-1 bg-white border rounded-lg border-gray-300">
                                <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="yes" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1753.7098760163587!2d-3.7178928203997126!3d42.33449148671665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd45fcc4d6a60457%3A0x8ec64bcb475d1d88!2sSofteca%20Internet%20SL!5e0!3m2!1ses!2ses!4v1743167459033!5m2!1ses!2ses" style="filter: contrast(1) opacity(0.9);"></iframe>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    Chart.defaults.font.size= 14;
    Chart.defaults.font.family= "'Roboto', sans-serif";
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Clientes', 'Productos', 'Vendedores', 'Relacíon'],
        datasets: [{
          label: 'Nº Last Month',
          data: [{{count($clients)}}, {{count($products)}}, {{count($sellers)}}, {{count($cli_pro)}}],
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
        }
      }
    });
</script>
