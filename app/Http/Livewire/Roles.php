<?php

namespace App\Http\Livewire;

use App\Models\Roles as ModelsRoles;
use App\Models\User;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Str;

class Roles extends Component
{
    use WireToast;

    public $open, $action, $search = '';
    public $nombre, $descripcion, $rol_id;

    protected $rules = [
        'nombre' => 'required|min:3',
        'descripcion' => 'required',

    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openDelete($id)
    {
        $this->open = true;
        $this->action = 'Eliminar';
        $this->rol_id = $id;
    }

    public function delete()
    {
        try {
            $users = User::where('id_rol', $this->rol_id)->get();
            if ($users->count() == 0) {

                $rol = ModelsRoles::find($this->rol_id);
                $rol = $rol->delete();
                if ($rol) {
                    toast()->success('Rol Eliminado')->push();
                    $this->closeModal();
                }
            } else {
                toast()->warning('Hay usuarios asignados a este rol')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->warning('Se ha encontrado una exepcion del sistema!!')->push();
        }
    }
    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $this->rol_id = $id;
        $rol = ModelsRoles::find($this->rol_id);
        $this->nombre = $rol->nombre;
        $this->descripcion = $rol->descripcion;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'descripcion', 'rol_id']);
    }
    public function update()
    {
        $this->validate();
        try {
            $rol = ModelsRoles::find($this->rol_id);
            $rol->nombre = $this->nombre;
            $rol->descripcion = $this->descripcion;
            $rol->updated_at = now();
            $rol->save();
            if ($rol) {
                toast()->success('Datos actualizados!!')->push();
                $this->closeModal();
            }
        } catch (\Throwable $th) {
            toast()->success('Verifique tus datos!!')->push();
        }
    }

    public function store()
    {
        $this->validate();
        try {
            if ($this->action == 'Registrar') {
                $clave = Str::random(24);
                $rol = new ModelsRoles();
                $rol->nombre = $this->nombre;
                $rol->descripcion = $this->descripcion;
                $rol->clave = $clave;
                $rol->save();
                if ($rol) {
                    $this->closeModal();
                    toast()->success('Elemento registrado correctamente')->push();
                }
            } else {
                //$clave = Str::random(24);

                $rol = ModelsRoles::find($this->rol_id);
                $rol->nombre = $this->nombre;
                $rol->descripcion = $this->descripcion;
                $rol->updated_at = now();
                $rol->save();
                if ($rol) {
                    toast()->success('Datos actualizados!!')->push();
                    $this->closeModal();
                }
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