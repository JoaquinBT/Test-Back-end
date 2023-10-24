<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $table = 'dispositivos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre_dispositivo', // Lista de columnas que se pueden llenar de forma masiva
    ];

    // Relaciones con otros modelos
    public function Modelos()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    // Relaciones con otras bodegas
    public function Bodegas()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }
}
