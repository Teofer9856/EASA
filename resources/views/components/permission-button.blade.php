@props(['color' => 'blue', 'client', 'route'])

@php
    switch ($color) {
        case 'blue':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 tooltip";
            break;
        case 'red':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 tooltip";
            break;
        case 'yellow':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 tooltip";
            break;
        case 'green':
            $class = "focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 tooltip";
            break;
        default:
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 tooltip";
            break;
    }
@endphp

<span>
    <a href="{{route($route, $client)}}">
        <button {{$attributes->merge(['class' => $class])}}>
            <span class="tooltiptext">PERMIT</span>
            <svg class="h-5 w-5" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10H6C4.89543 10 4 10.8954 4 12V38C4 39.1046 4.89543 40 6 40H42C43.1046 40 44 39.1046 44 38V29.5" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10 23H20" stroke="#000000" stroke-width="4" stroke-linecap="round"></path> <path d="M10 31H38" stroke="#000000" stroke-width="4" stroke-linecap="round"></path> <circle cx="34" cy="16" r="6" fill="#000000" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></circle> <path d="M44.0001 28.4187C42.0469 24.6023 38.153 22 33.6682 22C28.2313 22 23.663 25.8243 22.3677 31" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g>
            </svg>
        </button>
    </a>
</span>
