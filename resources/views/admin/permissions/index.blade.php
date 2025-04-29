<x-app-layout>
    <x-alert>{{session('status')}}</x-alert>
    @if ($errors->any())
        <x-alert-list></x-alert-list>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight content-center">
            {{ __('Admin Permissions') }}
        </h2>
        <div class="flex">
            <div class="dropdown dropdown-hover">
                <div tabindex="0" role="button" class="btn btn-outline btn-neutral m-1 border border-black">Mas Opciones</div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                  <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                  <li><a href="{{ route('admin.permissions.index') }}">Permisos</a></li>
                </ul>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">Name</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($permissions as $permission)
                              <tr class="hover:bg-base-300">
                                  <td class="px-6 py-4"><div aria-label="success" class="status status-success"></div></td>
                                  <td class="px-6 py-4">{{$permission->name}}</td>
                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
