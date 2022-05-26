<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.estados.index');
    }
}