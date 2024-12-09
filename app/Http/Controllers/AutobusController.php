<?php

namespace App\Http\Controllers;

use App\Models\Autobus;
use App\Models\Sucursal;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;




class AutobusController extends Controller
{
    // Método para obtener autobuses
    public function index(Request $request)
    {
        $autobuses = Autobus::with('sucursal', 'ruta')->get();

        // Si la solicitud es para una API, devuelve JSON
        if ($request->wantsJson()) {
            return response()->json($autobuses, 200);
        }

        // Si no, devuelve la vista para el sitio web
        return view('autobuses.index', compact('autobuses'));
    }

    // Método para mostrar el formulario de creación de autobús
    public function create()
    {
        Gate::authorize('admin');
        $sucursales = Sucursal::all();
        $rutas = Ruta::all();

        return view('autobuses.create', compact('sucursales', 'rutas'));
    }

    // Método para almacenar un autobús
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'NoSerie' => 'required|unique:autobuses',
            'modelo' => 'required',
            'capacidad' => 'required|integer|min:1',
            'placa' => 'required|unique:autobuses',
            'sucursal_id' => 'required|exists:sucursales,id',
            'ruta_id' => 'required|exists:rutas,id',
        ]);

        $autobus = Autobus::create($request->all());

        // Si es una solicitud API, retorna JSON
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Autobús creado exitosamente.', 'autobus' => $autobus], 201);
        }

        // Si es una solicitud de la web, redirige
        return redirect()->route('autobuses.index')->with('success', 'Autobús creado exitosamente.');
    }

    // Mostrar un autobús específico
    public function show(Autobus $autobus, Request $request)
    {
        // Si la solicitud es de una API, devuelve JSON
        if ($request->wantsJson()) {
            return response()->json($autobus, 200);
        }

        // Si no, devuelve la vista del autobús
        return view('autobuses.show', compact('autobus'));
    }

    // Actualizar un autobús
    public function update(Request $request, Autobus $autobus)
    {
        Gate::authorize('admin');

        $request->validate([
            'NoSerie' => 'required|unique:autobuses,NoSerie,' . $autobus->id,
            'modelo' => 'required',
            'capacidad' => 'required|integer|min:1',
            'placa' => 'required|unique:autobuses,placa,' . $autobus->id,
            'sucursal_id' => 'required|exists:sucursales,id',
            'ruta_id' => 'required|exists:rutas,id',
        ]);

        $autobus->update($request->all());

        // Si es una solicitud API, devuelve JSON
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Autobús actualizado exitosamente.', 'autobus' => $autobus], 200);
        }

        // Si no, redirige a la vista
        return redirect()->route('autobuses.index')->with('success', 'Autobús actualizado exitosamente.');
    }

    // Eliminar un autobús
    public function destroy(Autobus $autobus, Request $request)
    {
        Gate::authorize('admin');
        $autobus->delete();

        // Si es una solicitud API, devuelve JSON
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Autobús eliminado exitosamente.'], 200);
        }

        // Si no, redirige a la vista
        return redirect()->route('autobuses.index')->with('success', 'Autobús eliminado exitosamente.');
    }
}
