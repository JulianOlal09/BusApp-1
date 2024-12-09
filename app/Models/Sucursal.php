<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ruta;
use App\Models\Autobus;
use App\Models\Ticket;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $fillable = ['nombre', 'direccion', 'telefono'];

    // Relación uno a muchos con Rutas
    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }

    // Relación uno a muchos con Autobuses
    public function autobuses()
    {
        return $this->hasMany(Autobus::class);
    }

    // Relación uno a muchos con Tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
