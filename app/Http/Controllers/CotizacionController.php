<?php

namespace App\Http\Controllers;

use App\Models\Operaciones\Cotizacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    //

    public function index()
    {
        # code...
        $this->authorize('viewAny', Cotizacion::class);

        return view('pages.cotizaciones.index');
    }
}