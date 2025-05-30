@push('links')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <style>
        .tooltip .tooltiptext {
            width: 150px;
            height: 25px;
            top: 101%;
            left: 43%;
            margin-left: -33px;
            background-color: black;
            color: white;
        }
    </style>
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex-grow p-6 overflow-auto bg-gray-100">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="2xl:h-50 bg-white border rounded-lg border-gray-300 col-span-3 2xl:col-span-1">
                                <x-profits :profits="$profit"></x-profits>
                            </div>
                            <div class="2xl:h-50 bg-white border rounded-lg border-gray-300 tooltip col-span-3 2xl:col-span-1">
                                <span class="tooltiptext">Top Buyers</span>
                                <x-buyers :buyers="$topThree"></x-buyers>
                            </div>
                            <div class="h-50 bg-white border rounded-lg border-gray-300 col-span-3 2xl:col-span-1">
                                <x-stats :stats="$stats"></x-stats>
                            </div>
                            <div class="h-95 bg-white border rounded-lg border-gray-300 col-span-3 2xl:col-span-2 hidden sm:block">
                                <canvas id="myChart" data-chart="{{json_encode($data)}}"></canvas>
                            </div>
                            <div class="2xl:h-95 bg-white border rounded-lg border-black-300 col-span-3 2xl:col-span-1">
                                <div class="stat place-items-center mt-3">
                                    <div class="stat-value text-1xl text-primary text-3xl sm:text-4xl md:text-5xl 2xl:text-4xl mt-1">Most Sold</div>
                                    <div class="stat mt-2">
                                        <div class="stat-value text-success text-7xl sm:text-8xl md:text-9xl 2xl:text-8xl text-center">{{$mostSelledList['total']}}</div>
                                        <div class="stat-value text-success text-5xl sm:text-6xl md:text-7xl 2xl:text-6xl text-center">
                                            <span class="text-success text-4xl sm:text-5xl md:text-6xl 2xl:text-5xl">
                                                <div>
                                                    {{implode(' ', array_slice(explode(' ', $mostSelledList['name']), 0, 3))}}
                                                </div>
                                                <div class="mt-3 text-primary">
                                                    {{$mostSelledList['price']}} €
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="https://unpkg.com/cally"></script>
@vite('resources/js/chart.js')
