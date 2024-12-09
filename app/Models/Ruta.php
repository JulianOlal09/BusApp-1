<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sucursal;
use App\Models\Autobus;
use App\Models\Horario;
use App\Models\Ticket;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'origen', 'destino', 'sucursal_id'];

    // Relación inversa con Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    // Relación uno a muchos con Autobuses
    public function autobuses()
    {
        return $this->hasMany(Autobus::class);
    }

    // Relación uno a muchos con Horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    // Relación uno a muchos con Tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
