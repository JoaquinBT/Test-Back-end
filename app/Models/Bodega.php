<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = 'bodegas'; // Nombre de la tabla en la base de datos
    public $timestamps = false;
    protected $fillable = [
        'nombre_bodega', // Lista de columnas que se pueden llenar de forma masiva
    ];

    // Relaciones con otros dispositivos
    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class);
    }
}
