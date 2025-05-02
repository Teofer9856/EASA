<x-app-layout>
    <x-alert>{{session('status')}}</x-alert>
    @if ($errors->any())
        <x-alert-list></x-alert-list>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight content-center">
            {{ __('Productos') }}
        </h2>
        <div class="flex">
            @can('editar')
                <x-import-icon :route="route('products.import')"></x-import-icon>
            @endcan
            <x-export-icon :route="route('products.export')"></x-export-icon>
            <x-button-icon :route="route('products.create')"></x-button-icon>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-search :route="route('products.search')" :list="$names_list" :search="$input"></x-search>
                    <x-table :headers="$names_list" :route_delete="'products.destroy'" :route_edit="'products.edit'" :list="$products_list"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
