<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\Operaciones\TiposContratos as OperacionesTiposContratos;
use App\Models\TipoContrato;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class TiposContratos extends Component
{
    use WireToast;

    public $open, $action, $search = '';
    public $id_tcontrato, $nombre;

    protected $rules = [
        'nombre' => 'required',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $act = OperacionesTiposContratos::find($id);
        $this->id_tcontrato = $act->id;
        $this->nombre = $act->nombre;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'id_tcontrato']);
    }

    public function store()
    {
        # code...
        $this->validate();
        if ($this->action == 'Registrar') {
            # code...
            try {
                //code...
                $actividad = new OperacionesTiposContratos();
                $actividad->nombre = $this->nombre;
                $actividad->save();
                if ($actividad) {
                    # code...
                    $this->closeModal();
                    toast()->success('Tipo de contrato registrado!!')->push();
                }
            } catch (\Throwable $th) {
                //throw $th;
                toast()->info('Verifica tus datos!!')->push();
            }
        } else {
            $act = OperacionesTiposContratos::find($this->id_tcontrato);
            $act->nombre = $this->nombre;
            $act->updated_at = now();
            $act->save();
            if ($act) {
                $this->closeModal();
                toast()->success('Datos actualizados!!')->push();
            }
        }
    }

    public function render()
    {
        return view('livewire.operaciones.tipos-contratos', [
            'contratos' => OperacionesTiposContratos::all(),
        ]);
    }
}