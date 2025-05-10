<x-app-layout>
    <x-alert>{{session('status')}}</x-alert>
    @if ($errors->any())
        <x-alert-list></x-alert-list>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight content-center">
            {{ __('Admin') }}
        </h2>
        <div class="flex">
            {{-- <x-button-icon :route="route('clients.create')"></x-button-icon> --}}
            <div class="dropdown dropdown-hover">
                <div tabindex="0" role="button" class="btn btn-outline btn-neutral m-1 border border-black">More Options</div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-35 p-2 shadow-sm">
                    <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                </ul>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative  shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3"></th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Roles</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4"><div aria-label="status" class="status status-neutral status-md"></div></td>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->email }}</th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->roles[0]->name }}<td class="px-6 py-4">
                                            <x-permission-button color="yellow" :client="$user" route="admin.permissions.edit"></x-permission-button>
                                            <x-delete-button :route="'admin.destroy'" :object="$user">{{$user->name ?? "Corrige Esto"}}</x-delete-button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
