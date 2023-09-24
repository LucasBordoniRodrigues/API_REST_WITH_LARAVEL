<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DespesaController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('despesas')->group(function () {
    Route::get('/', [DespesaController::class, 'index'])->name('despesas.index');
    Route::get('/{id}', [DespesaController::class, 'show'])->name('despesas.show');
    Route::post('/', [DespesaController::class, 'store'])->name('despesas.store');
    Route::put('/{id}', [DespesaController::class, 'update'])->name('despesas.update');
    Route::delete('/{id}', [DespesaController::class, 'destroy'])->name('despesas.destroy');
});
