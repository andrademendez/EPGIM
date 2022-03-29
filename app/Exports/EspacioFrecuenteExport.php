<?php

namespace App\Exports;

use App\Models\Espacios;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class EspacioFrecuenteExport implements FromView
{
    public $unidad;

    public function __construct($unidad)
    {
        $this->unidad = $unidad;
    }

    public function view(): View
    {
        return view('exports.espacioFrecuente', [
            'espacios' => DB::table('campania_espacio')
                ->join('espacios', 'campania_espacio.id_espacio', '=', 'espacios.id')
                ->join('campanias', 'campania_espacio.id_campania', '=', 'campanias.id')
                ->join('unidades_negocios', 'espacios.id_unidad_negocio', '=', 'unidades_negocios.id')
                ->selectRaw('espacios.*, count(campanias.id) as total, sum(espacios.precio) as importe, unidades_negocios.nombre as unidad')
                ->where([
                    ['campanias.end', '<', now()],
                    ['unidades_negocios.nombre', 'LIKE', "%$this->unidad%"]
                ])
                ->whereIn(
                    'campanias.status',
                    ['Confirmado', 'Cerrado']
                )
                ->groupBy('espacios.id')
                ->orderBy('total', 'desc')
                ->limit(10)->get(),
        ]);
    }
}