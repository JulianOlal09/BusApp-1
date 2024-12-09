<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RutaController extends Controller
{
    // Este método maneja las solicitudes tanto para la vista web como para la API
    public function index(Request $request)
    {
        // Si es una solicitud de la API (verificamos si está en formato JSON)
        if ($request->wantsJson()) {
            $query = Ruta::query();

            // Filtrar por origen si se proporciona el parámetro
            if ($request->has('origen')) {
                $query->where('origen', $request->origen);
            }

            // Filtrar por destino si se proporciona el parámetro
            if ($request->has('destino')) {
                $query->where('destino', $request->destino);
            }

            // Obtener las rutas con la sucursal relacionada
            $rutas = $query->with('sucursal')->get();

            // Devolver respuesta JSON para la API
            return response()->json($rutas);
        }

        // Si es una solicitud web (página)
        $rutas = Ruta::with('sucursal')->get();
        return view('rutas.index', compact('rutas'));
    }

    // Método para la creación de rutas (solo accesible para usuarios admin)
    public function create()
    {
        Gate::authorize('admin');
        $sucursales = Sucursal::all();
        return view('rutas.create', compact('sucursales'));
    }

    // Almacena una nueva ruta
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'nombre' => 'required|max:255',
            'origen' => 'required',
            'destino' => 'required',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);

        Ruta::create($request->all());

        return redirect()->route('rutas.index')->with('success', 'Ruta creada exitosamente.');
    }

    // Muestra una ruta específica
    public function show(Ruta $ruta)
    {
        return view('rutas.show', compact('ruta'));
    }

    // Edita una ruta específica (solo accesible para admin)
    public function edit(Ruta $ruta)
    {
        Gate::authorize('admin');
        $sucursales = Sucursal::all();
        return view('rutas.edit', compact('ruta', 'sucursales'));
    }

    // Actualiza una ruta
    public function update(Request $request, Ruta $ruta)
    {
        Gate::authorize('admin');

        $request->validate([
            'nombre' => 'required|max:255',
            'origen' => 'required',
            'destino' => 'required',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);

        $ruta->update($request->all());

        return redirect()->route('rutas.index')->with('success', 'Ruta actualizada exitosamente.');
    }

    // Elimina una ruta
    public function destroy(Ruta $ruta)
    {
        Gate::authorize('admin');
        $ruta->delete();
        return redirect()->route('rutas.index')->with('success', 'Ruta eliminada exitosamente.');
    }
}
