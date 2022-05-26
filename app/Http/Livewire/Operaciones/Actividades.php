<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\Departamentos;
use App\Models\Operaciones\Actividades as OperacionesActividades;
use App\Models\User;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Actividades extends Component
{
    use WireToast;

    public $open, $action, $search = '';
    public $id_actividad, $nombre, $departamento;


    protected $rules = [
        'nombre' => 'required',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openAddDepa($id)
    {
        $this->open = true;
        $this->action = 'Departamento';
        $this->id_actividad = $id;
    }

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $act = OperacionesActividades::find($id);
        $this->id_actividad = $act->id;
        $this->nombre = $act->nombre;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'id_actividad', 'departamento']);
    }

    public function openDelete($id)
    {
        $this->open = true;
        $this->id_actividad = $id;
        $this->action = "Eliminar";
    }

    public function eliminarActividad()
    {
        # code...
        try {
            $del = OperacionesActividades::find($this->id_actividad);
            $affected = $del->delete();
            if ($affected) {
                # code...
                $this->closeModal();
                toast()->success('Registro Eliminado!!')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Verifique tus datos!!')->push();
        }
    }

    public function agregarDepartamento()
    {
        # code...
        try {
            $add = OperacionesActividades::find($this->id_actividad);
            $result = $add->departamentos()->syncWithoutDetaching($this->departamento);
            if ($result) {
                # code...
                $this->closeModal();
                toast()->success('Departamento agregado!!')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Verique los datos!!')->push();
        }
    }

    public function quitarDepartamento($act, $dep)
    {
        # code...
        $actt = OperacionesActividades::find($act);
        $affected = $actt->departamentos()->detach($dep);
        if ($affected) {
            # code...
            toast()->success('Elemento eliminado!!')->push();
        }
    }

    public function store()
    {
        # code...
        $this->validate();
        if ($this->action == 'Registrar') {
            # code...
            try {
                //code...
                $actividad = new OperacionesActividades();
                $actividad->nombre = $this->nombre;
                $actividad->save();
                if ($actividad) {
                    # code...
                    $this->closeModal();
                    toast()->success('Actividad registrado!!')->push();
                }
            } catch (\Throwable $th) {
                //throw $th;
                toast()->info('Verifica tus datos!!')->push();
            }
        } else {
            $act = OperacionesActividades::find($this->id_actividad);
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
        return view('livewire.operaciones.actividades', [
            'actividades' => OperacionesActividades::all(),
            'departamentos' => Departamentos::all(),
        ]);
    }
}