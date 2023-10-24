<?php

use App\Http\Controllers\BodegaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//rutas de bodega
Route::post('/post/bodega', [BodegaController::class, 'postBodega']);
Route::get('/bodegas', [BodegaController::class, 'getBodegas']);//ruta utilizada
//rutas de marca
Route::post('/post/marca', [MarcaController::class, 'postMarca']);
Route::get('/marcas', [MarcaController::class, 'getMarcas']);// Listar las marcas (id, nombre)
Route::get('/marca/{id}', [MarcaController::class, 'getMarca']);
//ruta para obtener lista de marcas por bodega
Route::get('/marcas/bodega/{nombre_bodega}', [MarcaController::class, 'getMarcasPorBodega']);//ruta utilizada

//rutas de modelo
Route::post('/post/modelo', [ModeloController::class, 'postModelo']);
Route::get('/modelos', [ModeloController::class, 'getModelos']);//ruta utilizada
Route::get('/modelo/{id}', [ModeloController::class, 'getModelo']);

//ruta para obtener lista de modelos por su marca
Route::get('/modelo/marca/{marca_id}', [ModeloController::class, 'getModelosPorMarca']);// Listar modelos de una marca (id, nombre, marca)
Route::get('/modelo/marca/nombre/{nombre_marca}', [ModeloController::class, 'getModelosPorMarcaNombre']);// Listar modelos de una marca (id, nombre, marca)
//ruta para obtener lista de modelos por su bodega y marca
Route::get('/modelo/bodegaymarca/nombre/{nombre_bodega}/{nombre_marca}', [ModeloController::class, 'getModelosPorBodegaYMarcaNombre']);//ruta utilizada


//rutas de dispositivo
Route::post('/post/dispositivo', [DispositivoController::class, 'postDispositivo']);//ruta utilizada
Route::get('/dispositivo/{id}', [DispositivoController::class, 'getDispositivo']);
Route::get('/dispositivos', [DispositivoController::class, 'getDispositivos']);
Route::get('/dispositivosConNombres', [DispositivoController::class, 'getDispositivosConNombres']);//ruta utilizada

//rutas para obtener dispositivo por bodega
Route::get('/dispositivo/bodega/{bodega_id}', [DispositivoController::class, 'getDispositivoPorBodega']);
Route::get('/dispositivo/bodega/nombre/{bodega_nombre}', [DispositivoController::class, 'getDispositivoPorBodegaNombre']);//ruta utilizada
//rutas para obtener dispositivo por marca
Route::get('/dispositivo/marca/{marca_id}', [DispositivoController::class, 'getDispositivosPorMarca']);
Route::get('/dispositivo/marca/nombre/{nombre_marca}', [DispositivoController::class, 'getDispositivoPorMarcaNombre']);
Route::get("/dispositivo/bodega/marca/nombre/{nombre_bodega}/{nombre_marca}", [DispositivoController::class, 'getDispositivoPorBodegaPorMarca']);//ruta utilizada

//rutas para obtener dispositivo por modelo
Route::get('/dispositivo/modelo/{modelo_id}', [DispositivoController::class, 'getDispositivoPorModelo']);
Route::get('/dispositivo/modelo/nombre/{nombre_modelo}', [DispositivoController::class, 'getDispositivoPorModeloNombre']);
Route::get('/dispositivo/bodega/marca/modelo/nombre/{nombre_bodega}/{nombre_marca}/{nombre_modelo}', [DispositivoController::class, 'getDispositivoPorBodegaPorMarcaPorModelo']);//ruta utilizada



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
