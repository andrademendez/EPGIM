<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    //

    public function index()
    {
        # code...
        return view('pages.cotizaciones.index');
    }
}