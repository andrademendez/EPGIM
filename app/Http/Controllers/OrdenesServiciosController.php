<?php

namespace App\Http\Controllers;

use App\Models\Operaciones\OrdenesServicios;
use Illuminate\Http\Request;

class OrdenesServiciosController extends Controller
{
    //
    public function index()
    {
        # code...
        $this->authorize('viewAny', OrdenesServicios::class);
        return view('pages.ordenes.index');
    }

    public function show($id)
    {
        # code...
        $this->authorize('viewAny', OrdenesServicios::class);

        $orden = OrdenesServicios::find($id);
        return view('pages.ordenes.show', compact('orden'));
    }
}