<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratosController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.contratos.index');
    }
}