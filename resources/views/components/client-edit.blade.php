<x-backButton :route="route('clients.index')"></x-backButton>
<form class="max-w-md mx-auto" method="POST" action="{{route('clients.update', $client)}}">
    @csrf
    @method('PUT')

    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lionel Messi" value="{{old('name', $client->name)}}" required />
        @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
        @enderror
    </div>

    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="world@champion.es" value="{{old('email', $client->email)}}" required />
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
        @enderror
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
            <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
            <input type="text" id="zip_code" name="zip_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="XXXXX" value="{{old('zip_code', $client->zip_code)}}" required />
            @error('zip_code')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provincia</label>
            <select name="province_id" value="{{old('province_id', $client->province_id)}}" class="search bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($provinces as $item)
                @if ($client->province_id == $item->id)
                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endif
                @endforeach
            </select>
            @error('province_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="mb-5">
        <label for="seller" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vendedor</label>
        <select name="seller_id" value="{{old('seller_id', $client->seller_id)}}" class="search bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($sellers as $item)
                @if ($client->seller_id == $item->id)
                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                @else
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endif
            @endforeach
        </select>
        @error('province_id')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
        @enderror
    </div>

    <div class="relative z-0 w-full mb-5 group">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
    </div>
</form>