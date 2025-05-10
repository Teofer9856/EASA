<x-backButton :route="route('admin.users.index')"></x-backButton>
<form class="max-w-md mx-auto" method="POST" action="{{route('admin.permissions.update', $client)}}">
    @csrf
    @method('PUT')

    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">UserName</label>
        <div class="flex">
            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                </svg>
            </span>
            <input type="text" id="name" name="name" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lionel Messi" value="{{old('name', $client->name)}}" required />
        </div>
        @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
        @enderror
    </div>

    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <div class="flex">
            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                </svg>
            </span>
            <input type="email" id="email" name="email" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="world@champion.es" value="{{old('email', $client->email)}}" required disabled/>
        </div>
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
        @enderror
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
            <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roles</label>
            <select id="roles" name="roles" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($roles->pluck('name')->toArray() as $role)
                    @if($userRole == $role)
                        <option value="{{ $role }}" selected>{{$role}}</option>
                    @else
                        <option value="{{ $role }}">{{$role}}</option>
                    @endif
                @endforeach
            </select>
            @error('permissions')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
            @enderror
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
            <select multiple id="permissions" name="permissions[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option></option>
                    @foreach ($permissions as $permission)
                        @php
                            $isRolePermission = in_array($permission->name, $rolePermissions);
                            $isUserPermission = in_array($permission->name, $userPermissions);
                        @endphp
                        <option value="{{ $permission->name }}" {{ $isRolePermission ? 'selected disabled' : ($isUserPermission ? 'selected' : '') }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
            </select>
            @error('permissions')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="relative z-0 w-full mb-5 group">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
    </div>
</form>
