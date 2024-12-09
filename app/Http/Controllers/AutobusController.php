<?php

namespace App\Http\Controllers;

use App\Models\Autobus;
use App\Models\Sucursal;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AutobusController extends Controller
{
    public function index()
    {
        $autobuses = Autobus::with('sucursal', 'ruta')->get();
        return view('autobuses.index', compact('autobuses'));
    }

    public function create()
    {
        Gate::authorize('admin');
        $sucursales = Sucursal::all();
        $rutas = Ruta::all();
        return view('autobuses.create', compact('sucursales', 'rutas'));
    }

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

        Autobus::create($request->all());
        return redirect()->route('autobuses.index')->with('success', 'Autobús creado exitosamente.');
    }

    public function show(Autobus $autobus)
    {
        return view('autobuses.show', compact('autobus'));
    }

    public function edit(Autobus $autobus)
    {
        Gate::authorize('admin');
        $sucursales = Sucursal::all();
        $rutas = Ruta::all();
        return view('autobuses.edit', compact('autobus', 'sucursales', 'rutas'));
    }

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
        return redirect()->route('autobuses.index')->with('success', 'Autobús actualizado exitosamente.');
    }

    public function destroy(Autobus $autobus)
    {
        Gate::authorize('admin');
        $autobus->delete();
        return redirect()->route('autobuses.index')->with('success', 'Autobús eliminado exitosamente.');
    }
}
