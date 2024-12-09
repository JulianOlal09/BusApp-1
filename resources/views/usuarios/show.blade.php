<!-- resources/views/usuarios/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800">Información del Usuario</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Nombre: </span>
                                    <span class="text-gray-600">{{ $user->name }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Email: </span>
                                    <span class="text-gray-600">{{ $user->email }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Rol: </span>
                                    <span class="text-gray-600">{{ $user->rol }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Fecha de Creación: </span>
                                    <span class="text-gray-600">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Última Actualización: </span>
                                    <span class="text-gray-600">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="inline">
                                    <span class="font-medium text-gray-700">Foto de Perfil: </span>
                                    <span class="text-gray-600">
                                        @if($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Foto de Perfil" class="w-12 h-12 rounded-full">
                                        @else
                                            No disponible
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="inline-block bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition duration-300">
                                Editar Usuario
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
