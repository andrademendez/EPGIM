<?php

namespace App\Http\Livewire\Espacio;

use App\Models\TiposEspacios;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Abstracto extends Component
{
    use WithPagination;

    public $search = '', $searchUnidad, $searchTipo;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function render()
    {
        return view('livewire.espacio.abstracto', [
            'espacios' => DB::table('campania_espacio')
                ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
                ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                ->join('unidades_negocios', 'unidades_negocios.id', '=', 'espacios.id_unidad_negocio')
                ->join('tipos_espacios', 'tipos_espacios.id', '=', 'espacios.id_tipo_espacio')
                ->join('ubicaciones_espacios', 'ubicaciones_espacios.id', '=', 'espacios.id_ubicacion')
                ->selectRaw("count(*) as total, espacios.*, unidades_negocios.nombre as unidad, tipos_espacios.nombre as tipo, ubicaciones_espacios.nombre as ubicacion")
                ->whereIn('campanias.status', ['Confirmado', 'Cerrado'])
                ->where([
                    ['campanias.end', '>', now()],
                    ['espacios.nombre', 'LIKE', "%$this->search%"],
                    ['unidades_negocios.nombre', 'LIKE', "%$this->searchUnidad%"],
                    ['tipos_espacios.nombre', 'LIKE', "%$this->searchTipo%"]
                ])
                ->groupBy('espacios.id')
                ->paginate(15),
            'tipos' => TiposEspacios::all(),
            'unidades' => UnidadesNegocios::all()
        ]);
    }

    public function resetear()
    {
        $this->searchTipo = '';
        $this->searchUnidad = '';
    }
}