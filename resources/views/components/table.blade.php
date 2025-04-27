@props(['align' => 1, 'route_delete', 'route_edit', 'headers', 'list'])
@php
    switch ($align) {
        case 1:
            $class = 'text-start';
            break;
        case 2:
            $class = 'text-center';
            break;
        default:
            # code...
            break;
    }
@endphp
<div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($headers as $value)
                        @if ($value != 'id')
                            <th scope="col" {{$attributes->merge(['class' => 'px-4 py-3' . $class])}}>
                                @switch($value)
                                    @case($value == "province_id")
                                        @sortablelink('province')
                                        @break
                                    @case($value == "seller_id")
                                        @sortablelink('seller')
                                        @break
                                    @case($value == "client_id")
                                        @sortablelink('client')
                                        @break
                                    @case($value == "product_id")
                                        @sortablelink('product')
                                        @break
                                    @default
                                        @sortablelink($value)
                                @endswitch
                            </th>
                        @else
                            <th scope="col" class="px-4 py-3 text-center"></th>
                        @endif
                    @endforeach
                    <th class="px-4 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    @foreach ($list as $value)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            @foreach ($headers as $name)
                                @if ($name != 'id')
                                    <td {{$attributes->merge(['class' => 'px-4 py-4' . $class])}}>
                                        {{($value->$name)}}
                                    </td>
                                @else
                                    <td class="px-4 py-4 text-center">
                                        <span class="flex w-3 h-3 me-3 bg-blue-600 rounded-full"></span>

                                    </td>
                                @endif
                            @endforeach
                            <td class="px-4 py-3 text-center">
                                <x-button :client="$value" :route="$route_edit" color="blue">EDIT</x-button>
                                <x-delete-button :route="$route_delete" :object="$value">{{$value->name ?? $value->id}}</x-delete-button>
                            </td>
                        </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
        {{$list->withQueryString()->links() }}
    </div>
</div>
