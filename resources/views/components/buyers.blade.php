<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th>Nº</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buyers as $key => $buyer)
            @if ($key == 0)
                <tr class="bg-base-200">
                    <th>{{$key += 1}}</th>
                    <td>{{$buyer['name']}}</td>
                    <td>{{$buyer['email']}}</td>
                </tr>
            @else
            <tr>
                <th>{{$key += 1}}</th>
                    <td>{{$buyer['name']}}</td>
                    <td>{{$buyer['email']}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
