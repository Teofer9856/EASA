<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight content-center">
            {{ __('Clientes') }}
        </h2>
        <x-button-icon></x-button-icon>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-search :list="$names_list" class="mb-4" :search="$input"></x-search>
                    <x-table :headers="$names_list" :list="$clients_list"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
