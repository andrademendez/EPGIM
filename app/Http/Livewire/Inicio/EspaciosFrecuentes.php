<?php

namespace App\Http\Livewire\Inicio;

use App\Exports\EspacioFrecuenteExport;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class EspaciosFrecuentes extends Component
{
    public $searchUnidad = "";

    public function exportExcel()
    {
        # code...
        return Excel::download(new EspacioFrecuenteExport($this->searchUnidad), 'espacios.xlsx');
    }
    public function render()
    {
        return view('livewire.inicio.espacios-frecuentes', [
            'espacios' => DB::table('campania_espacio')
                ->join('espacios', 'campania_espacio.id_espacio', '=', 'espacios.id')
                ->join('campanias', 'campania_espacio.id_campania', '=', 'campanias.id')
                ->join('unidades_negocios', 'espacios.id_unidad_negocio', '=', 'unidades_negocios.id')
                ->selectRaw('espacios.*, count(campanias.id) as total, sum(espacios.precio) as importe, unidades_negocios.nombre as unidad')
                ->where([
                    ['campanias.start', '<=', now()],
                    ['unidades_negocios.nombre', 'LIKE', "%$this->searchUnidad%"]
                ])
                ->whereIn(
                    'campanias.status',
                    ['Confirmado', 'Cerrado']
                )
                ->groupBy('espacios.id')
                ->orderBy('total', 'desc')
                ->limit(10)->get(),
            'unidades' => UnidadesNegocios::all()
        ]);
    }

    public function all()
    {
        $this->searchUnidad = "";
    }
}