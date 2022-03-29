<?php

namespace App\Http\Livewire\Campanias;

use App\Exports\OnlyCampaniaExport;
use App\Models\Campanias;
use App\Models\Medios;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Configuracion extends Component
{
    use WithPagination;

    public $search = '', $estatus, $condicion, $searchMedio, $searchEstatus, $searchUser;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function sutiacion($status)
    {
        if ($status == 'activo') {
            $this->estatus == '';
            $this->condicion = [
                ['start', '<', now()],
                ['end', '>', now()]
            ];
        } elseif ($status == 'pendiente') {
            $this->condicion  = [['start', '>', now()]];
        } elseif ($status == 'terminado') {
            $this->condicion  = [['end', '<', now()]];
        }
    }
    public function exportExcel()
    {

        return Excel::download(new OnlyCampaniaExport($this->estatus), 'campañas.xlsx');
    }

    public function render()
    {
        if ($this->estatus == 'activo') {
            $condicion = [
                ['start', '<', now()],
                ['end', '>', now()]
            ];
            $status = ['Cerrado', 'Confirmado'];
        } elseif ($this->estatus == 'pendiente') {
            $condicion  = [
                ['start', '>', now()]
            ];
            $status = ['Cerrado', 'Confirmado'];
        } elseif ($this->estatus == 'terminado') {
            $condicion  = [['end', '<', now()]];
            $status = ['Cerrado', 'Confirmado'];
        } else {
            $condicion  = [
                ['title', 'LIKE', "%$this->search%"],
                ['id_user', 'LIKE', "%$this->searchUser%"],
                ['id_medio', 'LIKE', "%$this->searchMedio%"],
            ];
            $status = ['Solicitud', 'Challenge', 'Confirmado', 'Cerrado'];
        }

        return view(
            'livewire.campanias.configuracion',
            [
                'usuarios' => User::all(),
                'medios' => Medios::all(),
                'campanias' => Campanias::where($condicion)
                    ->whereIn('status', $status)
                    ->paginate(15),
            ]
        );
    }
}