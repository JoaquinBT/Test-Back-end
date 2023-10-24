<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas'; // Nombre de la tabla en la base de datos
    public $timestamps = false;
    protected $fillable = [
        'nombre_marca', // Lista de columnas que se pueden llenar de forma masiva
    ];

    // Relaciones con otros modelos
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}