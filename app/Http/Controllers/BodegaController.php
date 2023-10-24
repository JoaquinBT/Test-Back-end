<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function getBodegas()
    {
        // Obtener todos los recursos
        $bodegas = Bodega::all();
        if (!$bodegas) {
            return response()->json(['error' => 'Bodegas no encontradas'], 404);
        }
        
        // Devolver una respuesta JSON
        return response()->json($bodegas);
    }

    public function postBodega(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre_bodega' => 'required|string',
        ]);
        // Obtener el nombre de la bodega del cuerpo de la solicitud
        $nombreBodega = $request->input('nombre_bodega');
        // Crear una nueva instancia de bodega y guardarla en la base de datos
        $bodega = new Bodega();
        $bodega->nombre_bodega = $nombreBodega;
        $bodega->save();
        // Devolver una respuesta JSON indicando éxito
        $data = ['mensaje' => 'Bodega creada con éxito', 'bodega'=>$bodega];
        return response()->json($data, 201);
    }
}
