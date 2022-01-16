<?php

namespace App\Http\Livewire;

use App\Models\Campanias as ModelsCampanias;
use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use DateTime;

class Campanias extends Component
{
    public $open, $action, $search = '';
    public $unidad, $nombre, $estatus, $start, $end, $ccliente, $cespacio, $id_campania, $cmedio;

    protected $listeners = [
        'openModalEvent' => 'openModal',
        'resetUnidad'

    ];

    public function resetUnidad()
    {
        # code...
        $this->unidad = 0;
    }
    public function mount()
    {
        $this->unidad = 0;
    }

    public function getevent()
    {
        $campanias = DB::table('vCampanias')->get();
        return  json_encode($campanias);
    }

    public function openModal($id)
    {
        $this->open = true;
        $this->action = 'Registrar';
        $this->id_campania = $id;
        $camp = ModelsCampanias::find($id);
        $this->nombre = $camp->title;
        $this->start = $camp->dateFormato($camp->start);
        $this->end = $camp->dateFormato($camp->end);
        $this->estatus = $camp->status;
        $this->ccliente = $camp->id_cliente;
        $this->cmedio = $camp->id_medio;
    }


    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'estatus', 'start', 'end', 'ccliente', 'cespacio', 'id_campania', 'cmedio']);
        $this->emit('resetUnidad');
    }
    public function openEdit()
    {
        $this->open = true;
    }

    public function openDelete()
    {
        $this->open = true;
    }

    //agregar espacio en el formulario de editar
    public function agregarEspacio()
    {
        //$this->authorize('update', Calendario::class);
        $user = Auth::id();
        $campania = ModelsCampanias::find($this->id_campania);

        if ($user == $campania->id_user) {
            $existen = $this->validarEspacio($this->start, $this->end, $this->cespacio);
            if ($existen <= 12) {
                $campania->espacios()->syncWithoutDetaching($this->cespacio);
                $this->showAlert('Espacio agregado!!', 'success');
            } else {
                $this->showAlert('El espacio esta reservado!!', 'info');
            }
        } else {
            $this->showAlert('Espacio agregado!!', 'error');
        }
    }
    //quitar espacio en el formulario de editar
    public function eliminarEspacio($id)
    {
        $user = Auth::id();
        $evento = ModelsCampanias::findOrFail($this->id_campania);
        try {
            if ($user == $evento->id_user) {
                if ($evento->status == 'Confirmado') {
                    return response()->json(['info', 'Espacios reservados no se pueden eliminar']);
                } else {
                    $delof = $evento->espacios()->detach($id);
                    if ($delof) {
                        $this->showAlert('Espacio eliminado!!', 'success');
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error al eliminar espacio!!', 'error');
        }
    }

    public function render()
    {
        return view('livewire.campanias', [
            'campania' => ModelsCampanias::find($this->id_campania),
            'unidades' => UnidadesNegocios::all(),
            'medios' => Medios::all(),
            'clientes' => Clientes::all(),
            'espacios' => Espacios::all(),
        ]);
    }

    function validarEspacio($start, $end, $espacio)
    {
        $date_start = new DateTime($start);
        $date_start = $date_start->format('Y-m-d');
        $date_end = new DateTime($end);
        $date_end = $date_end->format('Y-m-d');

        $existen = DB::table('vFechaBloqueov2')
            ->where([
                ['id_pantalla', '=', $espacio],
                ['estatus', '=', 'Confirmado']
            ])
            ->whereBetween('fecha', [$date_start, $date_end])
            ->get();
        return $existen->count();
    }

    public function showAlert($mensaje, $icons)
    {
        $this->emit('swal:alert', [
            'icon' => $icons,
            'type'    => 'success',
            'title'   => $mensaje,
            'timeout' => 3000
        ]);
    }
}