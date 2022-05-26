<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    //

    public function catalogos()
    {
        return view('pages.operaciones.catalogos');
    }
}