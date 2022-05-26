<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\Operaciones\TiposOrdenes as OperacionesTiposOrdenes;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class TiposOrdenes extends Component
{

    use WireToast;

    public $open, $action, $search = '';
    public $id_tordenes, $nombre;

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
        $act = OperacionesTiposOrdenes::find($id);
        $this->id_tordenes = $act->id;
        $this->nombre = $act->nombre;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'id_tordenes']);
    }

    public function store()
    {
        # code...
        $this->validate();
        if ($this->action == 'Registrar') {
            try {
                //code...
                $actividad = new OperacionesTiposOrdenes();
                $actividad->nombre = $this->nombre;
                $actividad->save();
                if ($actividad) {
                    # code...
                    $this->closeModal();
                    toast()->success('Tipo de orden registrado!!')->push();
                }
            } catch (\Throwable $th) {
                //throw $th;
                toast()->info('Verifica tus datos!!')->push();
            }
        } else {
            $act = OperacionesTiposOrdenes::find($this->id_tordenes);
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
        return view('livewire.operaciones.tipos-ordenes', [
            'ordenes' => OperacionesTiposOrdenes::all(),
        ]);
    }
}