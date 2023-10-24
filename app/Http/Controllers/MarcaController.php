<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use App\Models\Dispositivo;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function getMarcas()
    {
        // Obtener todos los recursos
        $marcas = Marca::all();
        if (!$marcas) {
            return response()->json(['error' => 'Marcas no encontradas'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($marcas);
    }

    public function getMarcasPorBodega($nombre_bodega)
    {
        $bodega = Bodega::where('nombre_bodega', $nombre_bodega)->first();
        if (!$bodega) {
            return response()->json(['error' => 'Bodega no encontrada'], 404);
        }
        
        $dispositivos = $bodega->dispositivos;
        if ($dispositivos->isEmpty()) {
            
            return response()->json([], 200);
        }
        $modelos = $dispositivos->pluck('modelos')->unique(); 
        
        $marcas = $modelos->pluck('marca')->unique()->map(function($marca)
        {
            return [
                'id' => $marca->id,
                'nombre_marca' => $marca->nombre_marca,
            ];
        })->sortBy('id')->values();

        return response()->json($marcas);
    }

    public function getMarca($id)
    {
        // Obtener un recurso por ID
        $marca = Marca::find($id);
        if (!$marca) {
            return response()->json(['error' => 'Marca no encontrada'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($marca);
    }

    public function postMarca(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre_marca' => 'required|string',
        ]);
        // Obtener el nombre de la marca del cuerpo de la solicitud
        $nombreMarca = $request->input('nombre_marca');
        // Crear una nueva instancia de Marca y guardarla en la base de datos
        $marca = new Marca();
        $marca->nombre_marca = $nombreMarca;
        $marca->save();
        // Devolver una respuesta JSON indicando éxito
        $data = ['mensaje' => 'Marca creada con éxito', 'marca'=>$marca];
        return response()->json($data, 201);
    }
}
