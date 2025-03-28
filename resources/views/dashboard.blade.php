<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <div class="bg-gray-100 min-h-screen">
                        <div class="flex flex-row pt-24 px-10 pb-4">
                            <div class="w-10/10">
                                <div class="flex flex-row">
                                <div class="bg-no-repeat bg-red-200 border border-red-300 rounded-xl w-7/12 mr-2 p-6" >
                                    <p class="text-5xl text-indigo-900">Welcome <br><strong>Lorem Ipsum</strong></p>
                                    <span class="bg-red-300 text-xl text-white inline-block rounded-full mt-12 px-8 py-2"><strong>01:51</strong></span>
                                </div>

                                <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-5/12 ml-2 p-6">
                                    <p class="text-5xl text-indigo-900">Inbox <br><strong>23</strong></p>
                                    <a href="" class="bg-orange-300 text-xl text-white underline hover:no-underline inline-block rounded-full mt-12 px-8 py-2"><strong>See messages</strong></a>
                                </div>
                                </div>
                                <div class="flex flex-row h-64 mt-6">
                                <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
                                    a
                                </div>
                                <div class="bg-white rounded-xl shadow-lg mx-6 px-6 py-4 w-4/12">
                                    b
                                </div>
                                <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
                                    c
                                </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="flex-grow p-6 overflow-auto bg-gray-100">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-2 bg-white border rounded-lg border-gray-300"></div>
                            <div class="h-50 col-span-1 bg-white border rounded-lg border-gray-300"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
