<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Ruta;
use App\Models\Autobus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HorarioController extends Controller
{

    public function index(Request $request)
{
    // Si es una solicitud de la API (verificamos si está en formato JSON)
    if ($request->wantsJson()) {
        $query = Horario::query();

        // Filtrar por ruta si se proporciona el parámetro
        if ($request->has('ruta_id')) {
            $query->where('ruta_id', $request->ruta_id);
        }

        //Corregir esta parte del controlador, pues no se que parametros debemos usar para filtrar por fecha
        // Filtrar por fecha si se proporciona el parámetro
        if ($request->has('fecha')) {
            $query->whereDate('HoraSalida', $request->fecha);
        }

        // Obtener los horarios con las relaciones de ruta y autobús
        $horarios = $query->with('ruta', 'autobus')->get();

        // Devolver respuesta JSON para la API
        return response()->json($horarios);
    }

    // Si es una solicitud web (página)
    $horarios = Horario::with('ruta', 'autobus')->get();
    return view('horarios.index', compact('horarios'));
}


    public function create()
    {
        Gate::authorize('admin');
        $rutas = Ruta::all();
        $autobuses = Autobus::all();
        return view('horarios.create', compact('rutas', 'autobuses'));
    }

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'HoraSalida' => 'required',
            'duracion' => 'required|integer',
            'ruta_id' => 'required|exists:rutas,id',
            'autobus_id' => 'required|exists:autobuses,id',
        ]);

        Horario::create($request->all());
        return redirect()->route('horarios.index')->with('success', 'Horario creado exitosamente.');
    }

    public function show(Horario $horario)
    {
        return view('horarios.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        Gate::authorize('admin');
        $rutas = Ruta::all();
        $autobuses = Autobus::all();
        return view('horarios.edit', compact('horario', 'rutas', 'autobuses'));
    }

    public function update(Request $request, Horario $horario)
    {
        Gate::authorize('admin');

        $request->validate([
            'HoraSalida' => 'required',
            'duracion' => 'required|integer',
            'ruta_id' => 'required|exists:rutas,id',
            'autobus_id' => 'required|exists:autobuses,id',
        ]);

        $horario->update($request->all());
        return redirect()->route('horarios.index')->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy(Horario $horario)
    {
        Gate::authorize('admin');
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado exitosamente.');
    }
}
