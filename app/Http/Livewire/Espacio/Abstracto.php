<?php

namespace App\Http\Livewire\Espacio;

use App\Exports\EspaciosExport;
use App\Models\Espacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Abstracto extends Component
{
    use WithPagination;

    public $search = '', $searchUnidad, $searchTipo,  $searchUbicacion;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function exportExcel()
    {

        return Excel::download(new EspaciosExport($this->searchUnidad, $this->searchTipo, $this->searchUbicacion), 'espacios.xlsx');
    }

    public function render()
    {
        return view('livewire.espacio.abstracto', [
            'espacios' => Espacios::where([
                ['nombre', 'LIKE', "%$this->search%"],
                ['id_unidad_negocio', 'LIKE', "%$this->searchUnidad%"],
                ['id_tipo_espacio', 'LIKE', "%$this->searchTipo%"],
                ['id_ubicacion', 'LIKE', "%$this->searchUbicacion%"],
            ])
                ->orWhere([
                    ['clave', 'LIKE', "%$this->search%"],
                    ['id_unidad_negocio', 'LIKE', "%$this->searchUnidad%"],
                    ['id_tipo_espacio', 'LIKE', "%$this->searchTipo%"],
                    ['id_ubicacion', 'LIKE', "%$this->searchUbicacion%"],
                ])
                ->orWhere([
                    ['referencia', 'LIKE', "%$this->search%"],
                    ['id_unidad_negocio', 'LIKE', "%$this->searchUnidad%"],
                    ['id_tipo_espacio', 'LIKE', "%$this->searchTipo%"],
                    ['id_ubicacion', 'LIKE', "%$this->searchUbicacion%"],
                ])
                ->paginate(15),
            'tipos' => TiposEspacios::all(),
            'ubicaciones' => Ubicacion::all(),
            'unidades' => UnidadesNegocios::all()
        ]);
    }

    public function resetear()
    {
        $this->searchTipo = '';
        $this->searchUnidad = '';
    }
}