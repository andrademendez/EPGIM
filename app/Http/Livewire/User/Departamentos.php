<?php

namespace App\Http\Livewire\User;

use App\Models\Departamentos as ModelsDepartamentos;
use App\Models\User;
use App\Notifications\ValidacionOrdenServicio;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\Notification;

class Departamentos extends Component
{

    use WireToast;

    public  $open, $action;
    public  $nombre, $descripcion, $usuario, $depa_id;

    protected $rules = [
        'nombre' => 'required|min:4',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openUpdate()
    {
        $this->open = true;
        $this->action = 'Actualizar';
    }
    public function openAddUser($id)
    {
        $this->open = true;
        $this->action = 'Usuario';
        $this->depa_id = $id;
    }

    public function openDelete($id)
    {
        $this->open = true;
        $this->id_user = $id;
        $this->action = 'eliminar';
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'descripcion', 'action', 'usuario']);
    }

    public function addUser()
    {
        # code...
        $depa = ModelsDepartamentos::find($this->depa_id);
        $add = $depa->users()->syncWithoutDetaching($this->usuario);
        if ($add) {
            # code...
            toast()->success('Usuario agregado!!')->push();
            $this->closeModal();
        }
    }

    public function removeUser($user, $dep)
    {
        # code...
        $depa = ModelsDepartamentos::find($dep);
        $remove = $depa->users()->detach($user);
        if ($remove) {
            toast()->success('Usuario removido del grupo!!')->push();
        }
    }

    public function store()
    {
        $this->validate();
        # code...
        try {
            //code...
            $depa = new ModelsDepartamentos();
            $depa->nombre = $this->nombre;
            $depa->descripcion = $this->descripcion;
            $depa->save();
            if ($depa) {
                # code...
                $this->closeModal();
                toast()->success('Departamento registrado!!')->push();
            } else {
                toast()->info('Revisa tus datos!!')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Revisa tus datos!!')->push();
        }
    }

    public function validador($user)
    {
        # code...
        $validador = DB::table('departamento_user')
            ->where('user_id', $user)
            ->update(['validador' => true, 'updated_at' => now()]);
        if ($validador) {
            toast()->success('Usuario se cambiado a Validador!!')->push();
            // Notification::route('mail', 'jandrade@delking.mx')->notify(new ValidacionOrdenServicio());
        }
    }

    public function notValidator($user)
    {
        # code...
        $validador = DB::table('departamento_user')
            ->where('user_id', $user)
            ->update(['validador' => false, 'updated_at' => now()]);
        if ($validador) {
            toast()->success('Usuario se cambiado a estándar!!')->push();
        }
    }

    public function render()
    {
        return view('livewire.user.departamentos', [
            'departamentos' => ModelsDepartamentos::all(),
            'users' => User::all(),
        ]);
    }
}