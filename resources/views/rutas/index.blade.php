<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rutas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('rutas.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4">Crear Ruta</a>

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

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Origen</th>
                                <th class="px-4 py-2 text-left">Destino</th>
                                <th class="px-4 py-2 text-left">Sucursal</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rutas as $ruta)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $ruta->id }}</td>
                                    <td class="px-4 py-2">{{ $ruta->nombre }}</td>
                                    <td class="px-4 py-2">{{ $ruta->origen }}</td>
                                    <td class="px-4 py-2">{{ $ruta->destino }}</td>
                                    <td class="px-4 py-2">{{ $ruta->sucursal->nombre }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('rutas.show', $ruta) }}" class="inline-block bg-cyan-500 text-white px-4 py-2 rounded-md hover:bg-cyan-600">Ver</a>
                                        <a href="{{ route('rutas.edit', $ruta) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Editar</a>
                                        <form action="{{ route('rutas.destroy', $ruta) }}" method="POST" class="inline">
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
