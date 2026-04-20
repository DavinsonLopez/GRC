<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ReporteController;
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

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', [ReporteController::class, 'dashboard']);

Route::get('/reportes', [ReporteController::class, 'index']);
Route::get('/reportes/create', [ReporteController::class, 'create']);
Route::post('/reportes', [ReporteController::class, 'store']);
Route::get('/reportes/{id}', [ReporteController::class, 'show']);
Route::get('/reportes/{id}/edit', [ReporteController::class, 'edit']);
Route::put('/reportes/{id}', [ReporteController::class, 'update']);
Route::delete('/reportes/{id}', [ReporteController::class, 'destroy']);

Route::post('/reportes/{id}/comentarios', [ComentarioController::class, 'store']);
