<?php

use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoEspacioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/ciudades', [HomeController::class, 'ciudad'])->name('ciudades');

    Route::get('/test', [CampaniaController::class, 'test']);

    Route::get('/all/campanias', [CampaniaController::class, 'getCampanias']);
    Route::get('/all/only_espacio', [CampaniaController::class, 'getEspacios']);
    Route::get('/only/espacio', [EspacioController::class, 'getOnlyEspacio']);
    Route::get('/only/get_espacio', [CampaniaController::class, 'get_espacio']);
    Route::get('/only/get_estatus', [CampaniaController::class, 'getOptions']);
    Route::post('/campanias/delete', [CampaniaController::class, 'destroy']);
    Route::post('/campanias/update', [CampaniaController::class, 'update']);
    Route::post('/campanias/addespacio', [CampaniaController::class, 'agregarEspacio']);
    Route::post('/campanias/delespacio', [CampaniaController::class, 'eliminarEspacio']);
    Route::get('/campanias/first', [CampaniaController::class, 'getFirstCampania']);
    Route::get('/challenge', [CampaniaController::class, 'show'])->name('challenge');
    Route::get('/campania/my-campania', function () {
        return view('pages.campanias.detalles');
    })->name('campania.detalles');
});

require __DIR__ . '/auth.php';
Route::group(['middleware' => 'auth'], function () {
    Route::resource('roles', RolesController::class)->only('index');
    Route::resource('user', UserController::class)->only('index', 'edit');
    Route::resource('campanias', CampaniaController::class)->except('create', 'edit');
    Route::resource('espacios', EspacioController::class)->only('index', 'edit');
    Route::resource('perfil', PerfilController::class)->only('edit');
    Route::resource('tipoespacio', TipoEspacioController::class)->only('index');
    Route::resource('clientes', ClienteController::class)->only('index');
    Route::resource('unidades', UnidadesController::class)->only('index');
    Route::resource('medios', MediosController::class)->only('index');
    Route::resource('espacios', EspacioController::class)->only('index', 'edit');
});