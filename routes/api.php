<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PadronController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [UserController::class, 'store']);

Route::get('/padron/download', [PadronController::class, 'download']);
Route::get('/padron/extractor', [PadronController::class, 'extractor']);
/** Inserta datos a la tabla empresas */
Route::get('/padron/loaddata', [PadronController::class, 'loaddata']);

/** Api de consulat de RUC */
Route::get('/ruc/{ruc}',[EmpresaController::class, 'ruc']);