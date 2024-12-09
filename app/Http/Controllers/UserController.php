<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $users = User::all();  // Obtener todos los usuarios
        return view('usuarios.index', compact('users'));  // Devuelve la vista con los usuarios
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder
        return view('usuarios.create');
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
            'rol' => 'required|in:admin,cliente',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
        ]);

        $user->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar los detalles de un usuario
    public function show($id)
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $user = User::findOrFail($id);
        return view('usuarios.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $user = User::findOrFail($id);
        return view('usuarios.edit', compact('user'));
    }

    // Actualizar la información de un usuario
    public function update(Request $request, $id)
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Si no se cambia la contraseña, puede ser null
            'rol' => 'required|in:admin,cliente',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->rol = $request->rol;
        $user->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        Gate::authorize('admin'); // Aseguramos que solo los admin puedan acceder

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
