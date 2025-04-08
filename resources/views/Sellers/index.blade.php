<x-app-layout>
    <x-alert>{{session('status')}}</x-alert>
    @if ($errors->any())
        <x-alert-list></x-alert-list>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight content-center">
            {{ __('Vendedores') }}
        </h2>
        <div class="flex">
            <x-import-icon :route="route('sellers.import')"></x-import-icon>
            <x-export-icon :route="route('sellers.export')"></x-export-icon>
            <x-button-icon :route="route('sellers.create')"></x-button-icon>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-search :route="route('sellers.search')" :list="$names_list" :search="$input"></x-search>
                    <x-table :headers="$names_list" :route_delete="'sellers.destroy'" :route_edit="'sellers.edit'" :list="$sellers_list"></x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
