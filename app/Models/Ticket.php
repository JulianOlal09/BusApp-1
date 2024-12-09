<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Autobus;
use App\Models\Sucursal;
use App\Models\Horario;
use App\Models\Ruta;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['CodigoReserva', 'precio', 'usuario_id', 'autobus_id', 'sucursal_id', 'horario_id', 'ruta_id'];

    // Relación inversa con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación inversa con Autobus
    public function autobus()
    {
        return $this->belongsTo(Autobus::class);
    }

    // Relación inversa con Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    // Relación inversa con Horario
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    // Relación inversa con Ruta
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
}
