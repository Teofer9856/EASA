<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Province</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buyers as $key => $buyer)
            @if ($key == 0)
                <tr class="bg-base-200">
                    <th>{{$key += 1}}</th>
                    <td>{{strtok($buyer['name'], ' ')}}</td>
                    <td>{{$buyer['email']}}</td>
                    <td>{{strtok($buyer['province']['name'], explode(' ', $buyer['province']['name'])[2])}}</td>
                </tr>
            @else
            <tr>
                <th>{{$key += 1}}</th>
                    <td>{{strtok($buyer['name'], ' ')}}</td>
                    <td>{{$buyer['email']}}</td>
                <td>{{strtok($buyer['province']['name'], explode(' ', $buyer['province']['name'])[2] ?? ' ')}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
