<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} 
            @if (Auth::user()->plan == 0)
                <span class="px-2 bg-gray-100 text-gray-600 rounded-md">Gratis</span>
            @endif
            @if (Auth::user()->plan == 1)
                <span class="px-2 bg-green-100 text-green-600 rounded-md">Básico</span>
            @endif
            @if (Auth::user()->plan == 2)
                <span class="px-2 bg-cyan-100 text-cyan-600 rounded-md">Estandar</span>
            @endif
            @if (Auth::user()->plan == 3)
                <span class="px-2 bg-yellow-100 text-yellow-600 rounded-md">Premium</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="app"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
