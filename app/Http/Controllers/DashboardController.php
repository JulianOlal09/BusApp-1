<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Ruta;
use App\Models\Autobus;
use App\Models\Horario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $sucursalesCount = Sucursal::count();
        $rutasCount = Ruta::count();
        $autobusesCount = Autobus::count();
        $horariosCount = Horario::count();

        return view('dashboard', compact('sucursalesCount', 'rutasCount', 'autobusesCount', 'horariosCount'));
    }
}