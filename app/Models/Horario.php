<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ruta;
use App\Models\Autobus;
use App\Models\Ticket;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['HoraSalida', 'duracion', 'ruta_id', 'autobus_id'];

    // Relación inversa con Ruta
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

    // Relación inversa con Autobus
    public function autobus()
    {
        return $this->belongsTo(Autobus::class);
    }

    // Relación uno a muchos con Tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
