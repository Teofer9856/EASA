    <div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-3">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @foreach ($headers as $value)
                                <th scope="col" class="px-4 py-3 text-center">
                                    {{$value}}
                                </th>
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
                                    <td class="px-4 py-4 text-center">
                                        {{($value->$name)}}
                                    </td>
                                @endforeach
                                <td class="px-4 py-3 text-center">
                                    <x-button :client="$value" color="blue">EDIT</x-button>
                                    <x-delete-button :object="$value"></x-delete-button>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            {{$list->withQueryString()->links() }}
        </div>
    </div>