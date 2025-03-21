<div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                        @if (!empty($list))
                            @foreach ($headers as $value)
                                <th scope="col" class="px-6 py-3">
                                    {{$value}}
                                </th>
                            @endforeach
                        @else
                            <th scope="col" class="px-6 py-3">
                                No content available
                            </th>
                        @endif
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    @foreach ($list as $value)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            @foreach ($headers as $name)
                                <td class="px-6 py-4">
                                    {{($value->$name)}}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>


</div>