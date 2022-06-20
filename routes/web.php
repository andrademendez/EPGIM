<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\EstadoCuentaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediosController;
use App\Http\Controllers\OperacionesController;
use App\Http\Controllers\OrdenesServiciosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TipoEspacioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('/ciudades', [HomeController::class, 'ciudad'])->name('ciudades');

    Route::get('/test', [HomeController::class, 'test']);

    //obtencion de los eventos por unidades
    Route::get('/all/campanias', [CalendarioController::class, 'getCampanias']);
    Route::get('/calendario/{calendario}', [CalendarioController::class, 'calendario'])->name('calendario.general');

    Route::get('/eventos/showcenter', [CalendarioController::class, 'getCampaniaShowcenter']);
    Route::get('/eventos/airo', [CalendarioController::class, 'getCampaniaAiro']);
    Route::get('/eventos/main', [CalendarioController::class, 'getCampaniaMain']);
    Route::get('/eventos/fashion', [CalendarioController::class, 'getCampaniaFashion']);
    Route::get('/campania/manager', [CalendarioController::class, 'managerCampania'])->name('campania.manager');
    Route::get('/eventos/settings', [CalendarioController::class, 'settings'])->name('eventos.settings');

    //
    Route::get('/all/only_espacio', [CampaniaController::class, 'getEspacios']);
    Route::get('/only/espacio', [EspacioController::class, 'getOnlyEspacio']);
    Route::get('/only/get_espacio', [CampaniaController::class, 'get_espacio']);
    Route::get('/only/get_estatus', [CampaniaController::class, 'getOptions']);
    Route::post('/campanias/delete', [CampaniaController::class, 'destroy']);
    Route::post('/campanias/update', [CampaniaController::class, 'update']);
    Route::post('/campanias/addespacio', [CampaniaController::class, 'agregarEspacio']);
    Route::post('/campanias/delespacio', [CampaniaController::class, 'eliminarEspacio']);
    Route::get('/campanias/first', [CampaniaController::class, 'getFirstCampania']);
    Route::get('/campanias/{id}/ordenes-servicios', [CampaniaController::class, 'ordenesServicio'])->name('campania.ordenes');
    Route::get('/campanias/{id}/cotizacion', [CampaniaController::class, 'cotizacion'])->name('campania.cotizacion');

    Route::get('/challenge', [CampaniaController::class, 'show'])->name('challenge');
    Route::get('/campania/detalles', [CampaniaController::class, 'detalles'])->name('campania.detalles');
    Route::get('/campania/{id}/detalles', [CampaniaController::class, 'detallesCampanias'])->name('detalles.detalles');

    //operaciones
    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizacion.index');
    Route::get('/operaciones/catalogos', [OperacionesController::class, 'catalogos'])->name('catalogos.index');
    Route::get('/ordenes', [OrdenesServiciosController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes/{id}/detalles', [OrdenesServiciosController::class, 'show'])->name('ordenes.show');
    Route::get('/contratos', [ContratosController::class, 'index'])->name('contratos.index');
    Route::get('/estado-cuenta', [EstadoCuentaController::class, 'index'])->name('estados.index');
});

require __DIR__ . '/auth.php';
Route::group(['middleware' => 'auth'], function () {
    Route::resource('roles', RolesController::class)->only('index');
    Route::resource('user', UserController::class)->only('index', 'edit');
    Route::resource('campanias', CampaniaController::class)->except('create', 'edit');
    Route::resource('espacios', EspacioController::class)->only('index', 'edit');
    Route::resource('perfil', PerfilController::class)->only('edit');
    Route::resource('tipoespacio', TipoEspacioController::class)->only('index');
    Route::resource('clientes', ClienteController::class)->only('index', 'show');
    Route::resource('departamentos', DepartamentosController::class)->only('index', 'show');
    // Route::resource('unidades', UnidadesController::class)->only('index');
    // Route::resource('medios', MediosController::class)->only('index');
    Route::resource('espacios', EspacioController::class)->only('index', 'edit');
});