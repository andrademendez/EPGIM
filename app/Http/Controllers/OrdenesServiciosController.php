<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenesServiciosController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.ordenes.index');
    }
}