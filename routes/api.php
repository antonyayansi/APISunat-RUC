<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PadronController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Orden para ejecutar la acualización de datos de la sunat. Ult Act. 11-08-2022 ✅ */
Route::get('/padron/download', [PadronController::class, 'download']);
Route::get('/padron/extractor', [PadronController::class, 'extractor']);
Route::get('/padron/loaddata', [PadronController::class, 'loaddata']);

/** Api de consulta de RUC */
Route::get('/ruc/{ruc}',[EmpresaController::class, 'ruc']);

Route::get('/tokens/{user_id}', [PermissionController::class, 'index']);
Route::post('/generate',[PermissionController::class, 'generate']);