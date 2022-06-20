<?php

namespace App\Http\Controllers;

use App\Models\Campanias;
use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    //

    public function catalogos()
    {
        $this->authorize('viewAny', Campanias::class);

        return view('pages.operaciones.catalogos');
    }
}