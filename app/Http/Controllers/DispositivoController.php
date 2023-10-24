<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use App\Models\Dispositivo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    public function getDispositivos()
    {
        // Obtener todos los recursos
        $dispositivos = Dispositivo::all();
        if (!$dispositivos) {
            return response()->json(['error' => 'Dispositivos no encontrados'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($dispositivos);
    }

    public function getDispositivosConNombres()
    {
        // Obtenemos todos los recursos (dispositivos, modelos y bodegas)
        $dispositivos = Dispositivo::all();
        $modelos = Modelo::all();
        $bodegas = Bodega::all();

        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelos, $bodegas) {
            $modeloNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->nombre_modelo;
            $bodegaNombre = $bodegas->where('id', $dispositivo->bodega_id)->first()->nombre_bodega;
            $marcaNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->marca->nombre_marca;
            
            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $marcaNombre,
                'nombre_modelo' => $modeloNombre,
                'nombre_bodega' => $bodegaNombre,
            ];
        });

        // Devolver una respuesta JSON con los nombres en lugar de los ID
        return response()->json($dispositivosTransformados);
    }

    public function getDispositivo($id)
    {
        // Obtener un recurso por ID
        $dispositivo = Dispositivo::find($id);
        if (!$dispositivo) {
            return response()->json(['error' => 'Dispositivo no encontrado'], 404);
        }
        // Devolver una respuesta JSON
        return response()->json($dispositivo);
    }

    public function getDispositivoPorModelo($modelo_id)
    {
        
        $modelo = Modelo::find($modelo_id);
        if (!$modelo) {
            return response()->json(['error' => 'Modelo no encontrado'], 404);
        }
        
        $dispositivos = $modelo -> dispositivos;
        if ($dispositivos === null || $dispositivos->isEmpty()) {
            return response()->json(['error' => 'El modelo esta registrado, pero no existe un dispositivo asociado'], 404);
        }
        
        return response()->json($dispositivos);
    }

    public function getDispositivosPorMarca($marcaId)
    {
        $marca = Marca::find($marcaId);

        if (!$marca) {
            return response()->json(['error' => 'Marca no encontrada'], 404);
        }

        $modelos = $marca->modelos;

        if ($modelos === null || $modelos->isEmpty()) {
            return response()->json(['error' => 'La marca esta registrada, pero no existen modelos asociados'], 404);
        }

        $dispositivos = [];

        foreach ($modelos as $modelo) {
            $dispositivos = array_merge($dispositivos, $modelo->dispositivos->toArray());
        }

        if (empty($dispositivos)) {
            return response()->json(['error' => 'La marca esta registrada, pero no existe un dispositivo asociado'], 404);
        }

        return response()->json($dispositivos);
    }

    public function getDispositivoPorBodega($bodega_id)
    {
        $bodega = Bodega::find($bodega_id);
        if (!$bodega) {
            return response()->json(['error' => 'Bodega no encontrada'], 404);
        }
        
        $dispositivos = $bodega -> dispositivos;
        if ($dispositivos === null || $dispositivos->isEmpty()) {
            return response()->json(['error' => 'La bodega esta registrada, pero no existe un dispositivo asociado'], 404);
        }
  
        return response()->json($dispositivos);
    }

    public function getDispositivoPorBodegaNombre($nombre_bodega)
    {
        $bodega = Bodega::where('nombre_bodega', $nombre_bodega)->first();

        if (!$bodega) {
            return response()->json(['error' => 'Bodega no encontrada'], 404);
        }

        $dispositivos = Dispositivo::where('bodega_id', $bodega->id)->get();
        if ($dispositivos->isEmpty()) {
            
            return response()->json([], 200);
        }
        $modelos = Modelo::all();
        $bodegas = Bodega::all();
        
        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelos, $bodegas) {
            $modeloNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->nombre_modelo;
            $bodegaNombre = $bodegas->where('id', $dispositivo->bodega_id)->first()->nombre_bodega;
            $marcaNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->marca->nombre_marca;
            
            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $marcaNombre,
                'nombre_modelo' => $modeloNombre,
                'nombre_bodega' => $bodegaNombre,
            ];
        });

        // Devolver una respuesta JSON con los nombres 
        return response()->json($dispositivosTransformados);
    }

    public function getDispositivoPorMarcaNombre($nombre_marca)
    {
        $dispositivos = Dispositivo::whereHas('modelos.marca', function ($query) use ($nombre_marca) {
            $query->where('nombre_marca', $nombre_marca);
        })->get();
        
        
        if ($dispositivos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron dispositivos para la marca dada.'], 404);
        }
    
        $modelos = Modelo::all();
        $bodegas = Bodega::all();
    
        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelos, $bodegas) {
            $modeloNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->nombre_modelo;
            $bodegaNombre = $bodegas->where('id', $dispositivo->bodega_id)->first()->nombre_bodega;
            $marcaNombre = $modelos->where('id', $dispositivo->modelo_id)->first()->marca->nombre_marca;
            
            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $marcaNombre,
                'nombre_modelo' => $modeloNombre,
                'nombre_bodega' => $bodegaNombre,
            ];
        });
    
        return response()->json($dispositivosTransformados);
    }

    public function getDispositivoPorModeloNombre($nombre_modelo)
    {
        $modelo = Modelo::where('nombre_modelo', $nombre_modelo)->first();

        if (!$modelo) {
            return response()->json(['error' => 'Modelo no encontrado'], 404);
        }

        $dispositivos = Dispositivo::where('modelo_id', $modelo->id)->get();
        if ($dispositivos->isEmpty()) {
            return response()->json(['error' => 'Modelo sin dispositivos'], 404);
        }
        
        $bodegas = Bodega::all();
        
        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelo, $bodegas) {
            $modeloNombre = $modelo->where('id', $dispositivo->modelo_id)->first()->nombre_modelo;
            $bodegaNombre = $bodegas->where('id', $dispositivo->bodega_id)->first()->nombre_bodega;
            $marcaNombre = $modelo->where('id', $dispositivo->modelo_id)->first()->marca->nombre_marca;
            
            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $marcaNombre,
                'nombre_modelo' => $modeloNombre,
                'nombre_bodega' => $bodegaNombre,
            ];
        });

        // Devolver una respuesta JSON con los nombres en lugar de los IDs
        return response()->json($dispositivosTransformados);
    }

    public function getDispositivoPorBodegaPorMarca($nombre_bodega, $nombre_marca)
    {
        $dispositivos = Dispositivo::whereHas('bodegas', function ($query) use ($nombre_bodega) {
            $query->where('nombre_bodega', $nombre_bodega);
        })->whereHas('modelos.marca', function ($query) use ($nombre_marca) {
            $query->where('nombre_marca', $nombre_marca);
        })->get();

        if ($dispositivos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron dispositivos para la bodega ' . $nombre_bodega . ' y la marca ' . $nombre_marca . '.'], 404);
        }
        
        $modelos = Modelo::whereIn('id', $dispositivos->pluck('modelo_id'))->get();

        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelos) {
            $modelo = $modelos->where('id', $dispositivo->modelo_id)->first();

            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $modelo->marca->nombre_marca,
                'nombre_modelo' => $modelo->nombre_modelo,
                'nombre_bodega' => $dispositivo->bodegas->nombre_bodega,
            ];
        });

        return response()->json($dispositivosTransformados);
    }

    public function getDispositivoPorBodegaPorMarcaPorModelo($nombre_bodega, $nombre_marca, $nombre_modelo)
    {
        $dispositivos = Dispositivo::whereHas('bodegas', function ($query) use ($nombre_bodega) {
            $query->where('nombre_bodega', $nombre_bodega);
        })->whereHas('modelos.marca', function ($query) use ($nombre_marca) {
            $query->where('nombre_marca', $nombre_marca);
        })->whereHas('modelos', function ($query) use ($nombre_modelo) {
            $query->where('nombre_modelo', $nombre_modelo);
        })->get();

        if ($dispositivos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron dispositivos para la bodega ' . $nombre_bodega . ', la marca ' . $nombre_marca . ' y el modelo ' . $nombre_modelo . '.'], 404);
        }

        $modelos = Modelo::whereIn('id', $dispositivos->pluck('modelo_id'))->get();

        $dispositivosTransformados = $dispositivos->map(function ($dispositivo) use ($modelos) {
            $modelo = $modelos->where('id', $dispositivo->modelo_id)->first();

            return [
                'id' => $dispositivo->id,
                'nombre_dispositivo' => $dispositivo->nombre_dispositivo,
                'nombre_marca' => $modelo->marca->nombre_marca,
                'nombre_modelo' => $modelo->nombre_modelo,
                'nombre_bodega' => $dispositivo->bodegas->nombre_bodega,
            ];
        });

        return response()->json($dispositivosTransformados);
    }




    public function postDispositivo(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre_dispositivo' => 'required|string',
            'bodega_id' => 'required|integer|exists:bodegas,id',
            'modelo_id' => 'required|integer|exists:modelos,id'
        ]);
        // Obtener el nombre del dispositivo del cuerpo de la solicitud
        $nombreDispositivo = $request->input('nombre_dispositivo');
        $bodegaID = $request->input('bodega_id');
        $modeloID = $request->input('modelo_id');
        // Crear una nueva instancia de dispositivo y guardarla en la base de datos
        $dispositivo = new Dispositivo();
        $dispositivo->nombre_dispositivo = $nombreDispositivo;
        $dispositivo->bodega_id = $bodegaID;
        $dispositivo->modelo_id = $modeloID;
        $dispositivo->save();
        // Devolver una respuesta JSON indicando éxito
        //$data = ['mensaje' => 'Dispositivo creado con éxito', 'dispositivo'=>$dispositivo];
        return response()->json($dispositivo, 201);
    }
}
