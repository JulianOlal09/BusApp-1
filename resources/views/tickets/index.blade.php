<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Crear Ticket</a>
                    
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-500 text-white p-2 rounded mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Código Reserva</th>
                                <th class="px-4 py-2">Usuario</th>
                                <th class="px-4 py-2">Placa del Autobús</th>
                                <th class="px-4 py-2">Sucursal</th>
                                <th class="px-4 py-2">Horario</th>
                                <th class="px-4 py-2">Ruta</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="border px-4 py-2">{{ $ticket->id }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->CodigoReserva }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->usuario->name }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->autobus->placa }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->sucursal->nombre }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->horario->HoraSalida }}</td>
                                    <td class="border px-4 py-2">{{ $ticket->ruta->nombre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="inline-block bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Ver</a>
                                        <a href="{{ route('tickets.edit', $ticket) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Editar</a>
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-block bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
