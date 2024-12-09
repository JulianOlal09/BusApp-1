<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SucursalController extends Controller
{
    // Mostrar el listado de sucursales
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        Gate::authorize('admin'); // Solo los admins pueden acceder
        return view('sucursales.create');
    }

    // Guardar nueva sucursal
    public function store(Request $request)
    {
        Gate::authorize('admin'); // Solo los admins pueden acceder

        $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        Sucursal::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }

    // Mostrar detalles de una sucursal
    public function show(Sucursal $sucursal)
    {
        return view('sucursales.show', compact('sucursal'));
    }

    // Mostrar formulario de edición
    public function edit(Sucursal $sucursal)
    {
        Gate::authorize('admin'); // Solo los admins pueden acceder
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar sucursal
    public function update(Request $request, Sucursal $sucursal)
    {
        Gate::authorize('admin'); // Solo los admins pueden acceder

        $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        $sucursal->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
    }

    // Eliminar sucursal
    public function destroy(Sucursal $sucursal)
    {
        Gate::authorize('admin'); // Solo los admins pueden acceder

        if ($sucursal->rutas()->exists() || $sucursal->autobuses()->exists() || $sucursal->tickets()->exists()) {
            return redirect()->route('sucursales.index')
                ->withErrors('No se puede eliminar la sucursal porque tiene datos relacionados.');
        }

        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
    }
}
