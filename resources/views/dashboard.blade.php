<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Botones del Dashboard -->
                    <a href="{{ route('sucursales.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Sucursales
                    </a>
                    <a href="{{ route('rutas.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Rutas
                    </a>
                    <a href="{{ route('autobuses.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Autobuses
                    </a>
                    <a href="{{ route('horarios.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Horarios
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Usuarios
                    </a>
                    <a href="{{ route('tickets.index') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                        Tickets
                    </a>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Estadísticas Generales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-100 p-4 rounded shadow">
                            <p class="font-semibold">Total de Sucursales</p>
                            <p class="text-2xl">{{ \App\Models\Sucursal::count() }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded shadow">
                            <p class="font-semibold">Total de Rutas</p>
                            <p class="text-2xl">{{ \App\Models\Ruta::count() }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded shadow">
                            <p class="font-semibold">Total de Autobuses</p>
                            <p class="text-2xl">{{ \App\Models\Autobus::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
