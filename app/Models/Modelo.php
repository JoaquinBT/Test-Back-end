<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'modelos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre_modelo', // Lista de columnas que se pueden llenar de forma masiva
    ];

    // Relaciones con otras marcas
    /*public function marcas()
    {
        return $this->belongsTo(Marca::class);
    }*/

    public function marca()
    {
        return $this->hasOne(Marca::class, 'id', 'marca_id');
    }

    // Relaciones con otros dispositivos
    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class);
    }
}
