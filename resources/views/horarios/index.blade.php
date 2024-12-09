<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Horarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('horarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Crear Horario</a>

                    <table class="min-w-full mt-6 table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Hora de Salida</th>
                                <th class="px-4 py-2">Duración</th>
                                <th class="px-4 py-2">Ruta</th>
                                <th class="px-4 py-2">Autobús</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($horarios as $horario)
                                <tr class border-b>
                                    <td class="px-4 py-2">{{ $horario->id }}</td>
                                    <td class="px-4 py-2">{{ $horario->HoraSalida }}</td>
                                    <td class="px-4 py-2">{{ $horario->duracion }} min</td>
                                    <td class="px-4 py-2">{{ $horario->ruta->nombre }}</td>
                                    <td class="px-4 py-2">{{ $horario->autobus->placa }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('horarios.show', $horario) }}" class="inline-block bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Ver</a>
                                        <a href="{{ route('horarios.edit', $horario) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Editar</a>
                                        <form action="{{ route('horarios.destroy', $horario) }}" method="POST" class="inline-block">
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
