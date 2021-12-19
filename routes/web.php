<?php

use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\MediosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoEspacioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Unidades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/ciudades', function () {
    return view('pages.ciudad.index');
})->middleware(['auth'])->name('ciudades');

require __DIR__ . '/auth.php';
Route::group(['middleware' => 'auth'], function () {
    Route::resource('roles', RolesController::class);
    Route::resource('user', UserController::class);
    Route::resource('campanias', CampaniaController::class);
    Route::resource('espacios', EspacioController::class);
    Route::resource('perfil', PerfilController::class);
    Route::resource('tipoespacio', TipoEspacioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('unidades', UnidadesController::class);
    Route::resource('medios', MediosController::class);
});