<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Autobús') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('autobuses.update', $autobus) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Número de Serie -->
                            <div class="mb-4">
                                <label for="NoSerie" class="block text-sm font-medium text-gray-700">Número de Serie</label>
                                <input type="text" name="NoSerie" id="NoSerie" value="{{ old('NoSerie', $autobus->NoSerie) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Modelo -->
                            <div class="mb-4">
                                <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $autobus->modelo) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Capacidad -->
                            <div class="mb-4">
                                <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                                <input type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', $autobus->capacidad) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required min="1">
                            </div>

                            <!-- Placa -->
                            <div class="mb-4">
                                <label for="placa" class="block text-sm font-medium text-gray-700">Placa</label>
                                <input type="text" name="placa" id="placa" value="{{ old('placa', $autobus->placa) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Sucursal -->
                            <div class="mb-4">
                                <label for="sucursal_id" class="block text-sm font-medium text-gray-700">Sucursal</label>
                                <select name="sucursal_id" id="sucursal_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}" {{ $autobus->sucursal_id == $sucursal->id ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ruta -->
                            <div class="mb-4">
                                <label for="ruta_id" class="block text-sm font-medium text-gray-700">Ruta</label>
                                <select name="ruta_id" id="ruta_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach($rutas as $ruta)
                                        <option value="{{ $ruta->id }}" {{ $autobus->ruta_id == $ruta->id ? 'selected' : '' }}>{{ $ruta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">
                                Actualizar Autobús
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
