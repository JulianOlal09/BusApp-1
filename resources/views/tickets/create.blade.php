<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Código Reserva -->
                            <div class="mb-4">
                                <label for="CodigoReserva" class="block text-sm font-medium text-gray-700">Código Reserva</label>
                                <input type="text" name="CodigoReserva" id="CodigoReserva" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Precio -->
                            <div class="mb-4">
                                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input type="number" name="precio" id="precio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Usuario -->
                            <div class="mb-4">
                                <label for="usuario_id" class="block text-sm font-medium text-gray-700">Usuario</label>
                                <select name="usuario_id" id="usuario_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Autobús -->
                            <div class="mb-4">
                                <label for="autobus_id" class="block text-sm font-medium text-gray-700">Placa del Autobús</label>
                                <select name="autobus_id" id="autobus_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach ($autobuses as $autobus)
                                        <option value="{{ $autobus->id }}">{{ $autobus->placa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sucursal -->
                            <div class="mb-4">
                                <label for="sucursal_id" class="block text-sm font-medium text-gray-700">Sucursal</label>
                                <select name="sucursal_id" id="sucursal_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Horario -->
                            <div class="mb-4">
                                <label for="horario_id" class="block text-sm font-medium text-gray-700">Horario</label>
                                <select name="horario_id" id="horario_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach ($horarios as $horario)
                                        <option value="{{ $horario->id }}">{{ $horario->HoraSalida }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ruta -->
                            <div class="mb-4">
                                <label for="ruta_id" class="block text-sm font-medium text-gray-700">Ruta</label>
                                <select name="ruta_id" id="ruta_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    @foreach ($rutas as $ruta)
                                        <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">
                                Crear Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
