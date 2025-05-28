<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect('/listar');
});
Route::get('/listar', [HomeController::class, 'listarRegistros']);
Route::get('/cargar', [HomeController::class, 'cargarRegistros']);
Route::post('/cargar_csv', [HomeController::class, 'cargarRegistrosCSV']);
Route::post('/listar_registros', [HomeController::class, 'obtenerListado']);
Route::post('/crear_registro', [HomeController::class, 'crearRegistro']);
Route::post('/actualizar_registro', [HomeController::class, 'actualizarRegistro']);
Route::post('/borrar_registro', [HomeController::class, 'borrarRegistro']);
