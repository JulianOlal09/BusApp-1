<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Horario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('horarios.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Hora de Salida -->
                            <div class="mb-4">
                                <label for="HoraSalida" class="block text-sm font-medium text-gray-700">Hora de Salida</label>
                                <input type="time" name="HoraSalida" id="HoraSalida" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Duración -->
                            <div class="mb-4">
                                <label for="duracion" class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                                <input type="number" name="duracion" id="duracion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required min="1">
                            </div>

                            <!-- Ruta -->
                            <div class="mb-4">
                                <label for="ruta_id" class="block text-sm font-medium text-gray-700">Ruta</label>
                                <select name="ruta_id" id="ruta_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach($rutas as $ruta)
                                        <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Autobús -->
                            <div class="mb-4">
                                <label for="autobus_id" class="block text-sm font-medium text-gray-700">Autobús</label>
                                <select name="autobus_id" id="autobus_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach($autobuses as $autobus)
                                        <option value="{{ $autobus->id }}">{{ $autobus->placa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">
                                Crear Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
