<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sucursal;
use App\Models\Ruta;
use App\Models\Horario;
use App\Models\Ticket;

class Autobus extends Model
{
    use HasFactory;

    protected $fillable = ['NoSerie', 'modelo', 'capacidad', 'placa', 'sucursal_id', 'ruta_id'];

    // Relación inversa con Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    // Relación inversa con Ruta
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
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
