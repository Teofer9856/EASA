@props(['color' => 'blue', 'client', 'type' => 'delete'])

@php
    switch ($color) {
        case 'blue':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";
            break;
        case 'red':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800";
            break;
        case 'yellow':
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800";
            break;
        default:
            $class = "px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";
            break;
    }

    switch ($type) {
        case 'edit':
            $route = route('clients.edit', $client);
            break;
        case 'delete':
            $route = route('clients.destroy', $client);
            break;
        default:
            break;
    }
@endphp

@if ($type == 'delete')
<span style="display: inline-block">
    <form method="POST" action="{{$route}}">
        @csrf
        @method('delete')

        <button type="submit" onclick="return confirm('Are you sure to delete this?')" {{$attributes->merge(['class' => $class])}}>{{$slot}}</button>
    </form>
</span>
@else
    <span><a href="{{$route}}" {{$attributes->merge(['class' => $class])}}>{{$slot}}</a></span>
@endif

