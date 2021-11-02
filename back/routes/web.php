<?php

use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\TipoDocumentoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/tipo')->group(function () {
    Route::get('/', [TipoDocumentoController::class, 'index']);
    Route::get('/{id}', [TipoDocumentoController::class, 'show']);
    Route::post('/', [TipoDocumentoController::class, 'store']);
    Route::put('/{id}', [TipoDocumentoController::class, 'update']);
    Route::delete('/{id}', [TipoDocumentoController::class, 'destroy']);
});

Route::prefix('/documento')->group(function () {
    Route::get('/', [DocumentoController::class, 'index']);
    Route::get('/{id}', [DocumentoController::class, 'show']);
    Route::post('/', [DocumentoController::class, 'store']);
    Route::put('/{id}', [DocumentoController::class, 'update']);//fazer
    Route::delete('/{id}', [DocumentoController::class, 'destroy']);//fazer
});

