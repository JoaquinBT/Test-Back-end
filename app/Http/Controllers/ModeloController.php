<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function getModelos()
    {
        // Obtener todos los recursos
        $modelos = Modelo::all();
        if (!$modelos) {
            return response()->json(['error' => 'Modelos no encontrados'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($modelos);
    }

    public function getModelo($id)
    {
        // Obtener un recurso por ID
        $modelo = Modelo::find($id);
        if (!$modelo) {
            return response()->json(['error' => 'Modelo no encontrado'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($modelo);
    }

    public function getModelosPorMarca($marca_id)
    {
        $marca = Marca::find($marca_id);
        
        if (!$marca) {
            return response()->json(['error' => 'Marca no encontrada'], 404);
        }

        $modelos = $marca->modelos;
        if ($modelos === null || $modelos->isEmpty()) {
            return response()->json(['error' => 'La marca esta registrada, pero no existe un modelo asociado'], 404);
        }
        return response()->json($modelos);
    }

    public function getModelosPorMarcaNombre($nombre_marca)
    {
        $marca = Marca::where('nombre_marca', $nombre_marca)->first();

        if (!$marca) {
            return response()->json(['error' => 'Marca no encontrada'], 404);
        }

        $modelos = Modelo::where('marca_id', $marca->id)->get();
        
        if ($modelos === null || $modelos->isEmpty()) {
            return response()->json(['error' => 'La marca esta registrada, pero no existe un modelo asociado'], 404);
        }
        return response()->json($modelos);
    }

    public function getModelosPorBodegaYMarcaNombre($nombre_bodega, $nombre_marca) {

        $modelos = Modelo::whereHas('marca', function ($query) use ($nombre_marca) {
            $query->where('nombre_marca', $nombre_marca);
        })->whereHas('dispositivos', function ($query) use ($nombre_bodega) {
            $query->whereHas('bodegas', function ($query) use ($nombre_bodega) {
                $query->where('nombre_bodega', $nombre_bodega);
            });
        })->get()->sortBy('id')->values();

        if ($modelos === null || $modelos->isEmpty()) {
            return response()->json(['error' => 'no existe un modelo asociado'], 404);
        }

        return response()->json($modelos);
    }



    public function postModelo(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre_modelo' => 'required|string',
            'marca_id' => 'required|integer|exists:marcas,id'
        ]);
        // Obtener el nombre del modelo del cuerpo de la solicitud
        $nombreModelo = $request->input('nombre_modelo');
        $marcaID = $request->input('marca_id');
        // Crear una nueva instancia de modelo y guardarla en la base de datos
        $modelo = new Modelo();
        $modelo->nombre_modelo = $nombreModelo;
        $modelo->marca_id = $marcaID;
        $modelo->save();
        // Devolver una respuesta JSON indicando éxito
        $data = ['mensaje' => 'Modelo creado con éxito', 'modelo'=>$modelo];
        return response()->json($data, 201);
    }
}
