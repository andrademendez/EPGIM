<?php

namespace App\Http\Controllers;

use App\Models\Operaciones\Contratos;
use Illuminate\Http\Request;

class ContratosController extends Controller
{
    //
    public function index()
    {
        # code...
        $this->authorize('viewAny', Contratos::class);
        return view('pages.contratos.index');
    }
}