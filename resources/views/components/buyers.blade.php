<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th class="hidden sm:block">Nº</th>
                <th>Name</th>
                <th class="hidden md:table-cell 2xl:hidden">Province</th>
                <th class="hidden lg:table-cell 2xl:hidden">Zip</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buyers as $key => $buyer)
            @if ($key == 0)
                <tr class="bg-base-200">
                    <th class="hidden sm:block">{{$key += 1}}</th>
                    <td>{{ implode(' ', array_slice(explode(' ', $buyer['name']), 0, 2)) }}</td>
                    <td class="hidden md:table-cell 2xl:hidden">{{$buyer->province->name}}</td>
                    <td class="hidden lg:table-cell 2xl:hidden">{{$buyer['zip_code']}}</td>
                    <td>{{$buyer['email']}}</td>
                </tr>
            @else
                <tr>
                    <th class="hidden sm:block">{{$key += 1}}</th>
                    <td>{{ implode(' ', array_slice(explode(' ', $buyer['name']), 0, 2)) }}</td>
                    <td class="hidden md:table-cell 2xl:hidden">{{$buyer->province->name}}</td>
                    <td class="hidden lg:table-cell 2xl:hidden">{{$buyer['zip_code']}}</td>
                    <td>{{$buyer['email']}}</td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
