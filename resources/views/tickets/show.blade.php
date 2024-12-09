<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800">Información del Ticket</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Código Reserva: </span>
                                    <span class="text-gray-600">{{ $ticket->CodigoReserva }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Precio: </span>
                                    <span class="text-gray-600">${{ $ticket->precio }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Usuario: </span>
                                    <span class="text-gray-600">{{ $ticket->usuario->name }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Placa del Autobús: </span>
                                    <span class="text-gray-600">{{ $ticket->autobus->placa }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Sucursal: </span>
                                    <span class="text-gray-600">{{ $ticket->sucursal->nombre }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Horario: </span>
                                    <span class="text-gray-600">{{ $ticket->horario->HoraSalida }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Ruta: </span>
                                    <span class="text-gray-600">{{ $ticket->ruta->nombre }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('tickets.edit', $ticket) }}" class="inline-block bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition duration-300">
                                Editar Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
