<?php

namespace App\Http\Livewire;

use App\Models\Roles as ModelsRoles;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Roles extends Component
{
    use WireToast;

    public $open, $action, $search = '';
    public $nombre, $descripcion;

    protected $rules = [
        'nombre' => 'required|min:3',
        'descripcion' => 'required',

    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function openEdit()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'descripcion']);
    }

    public function store()
    {
        $this->validate();
        try {
            $rol = new ModelsRoles();
            $rol->nombre = $this->nombre;
            $rol->descripcion = $this->descripcion;
            $rol->save();
            if ($rol) {
                $this->closeModal();
                toast()
                    ->success('Elemento registrado correcamente')
                    ->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()
                ->info('Verifique tus datos', 'Error')
                ->push();
        }
    }

    public function render()
    {
        return view('livewire.roles', [
            'roles' => ModelsRoles::all(),
        ]);
    }
}