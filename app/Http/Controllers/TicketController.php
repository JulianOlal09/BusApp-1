<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Autobus;
use App\Models\Sucursal;
use App\Models\Horario;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    // Mostrar la lista de tickets
    public function index(Request $request)
    {
        // Si es una solicitud de la API (verificamos si está en formato JSON)
        if ($request->wantsJson()) {
            $tickets = Ticket::with(['usuario', 'autobus', 'sucursal', 'horario', 'ruta'])->get();
            return response()->json($tickets);
        }

        // Si es una solicitud web (página)
        $tickets = Ticket::with(['usuario', 'autobus', 'sucursal', 'horario', 'ruta'])->get();
        return view('tickets.index', compact('tickets'));
    }

    // Mostrar el formulario para crear un nuevo ticket
    public function create()
    {
        Gate::authorize('admin');
        $usuarios = User::where('rol', 'cliente')->get();
        $autobuses = Autobus::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();
        $rutas = Ruta::all();

        return view('tickets.create', compact('usuarios', 'autobuses', 'sucursales', 'horarios', 'rutas'));
    }

    // Guardar un nuevo ticket
    public function store(Request $request)
    {
    $request->validate([
        'CodigoReserva' => 'required|unique:tickets',
        'precio' => 'required|numeric|min:0',
        'usuario_id' => 'required|exists:users,id',
        'autobus_id' => 'required|exists:autobuses,id',
        'sucursal_id' => 'required|exists:sucursales,id',
        'horario_id' => 'required|exists:horarios,id',
        'ruta_id' => 'required|exists:rutas,id',
    ]);

    $ticket = Ticket::create($request->all());

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Ticket creado exitosamente.', 'ticket' => $ticket], 201);
    }

    return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente.');
    }


    // Mostrar los detalles de un ticket
    public function show(Ticket $ticket)
    {
        $ticket->load(['usuario', 'autobus', 'sucursal', 'horario', 'ruta']);
        return view('tickets.show', compact('ticket'));
    }

    // Mostrar el formulario para editar un ticket
    public function edit(Ticket $ticket)
    {
        Gate::authorize('admin');
        $usuarios = User::where('rol', 'cliente')->get();
        $autobuses = Autobus::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();
        $rutas = Ruta::all();

        return view('tickets.edit', compact('ticket', 'usuarios', 'autobuses', 'sucursales', 'horarios', 'rutas'));
    }

    // Actualizar un ticket
    public function update(Request $request, Ticket $ticket)
    {
        Gate::authorize('admin');

        // Validar los parámetros necesarios para actualizar el ticket
        $request->validate([
            'CodigoReserva' => 'required|unique:tickets,CodigoReserva,' . $ticket->id,
            'precio' => 'required|numeric|min:0',
            'usuario_id' => 'required|exists:users,id',
            'autobus_id' => 'required|exists:autobuses,id',
            'sucursal_id' => 'required|exists:sucursales,id',
            'horario_id' => 'required|exists:horarios,id',
            'ruta_id' => 'required|exists:rutas,id',
        ]);

        // Actualizar el ticket con los datos proporcionados
        $ticket->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('tickets.index')->with('success', 'Ticket actualizado exitosamente.');
    }

    // Eliminar un ticket
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('admin');
        $ticket->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('tickets.index')->with('success', 'Ticket eliminado exitosamente.');
    }
}
