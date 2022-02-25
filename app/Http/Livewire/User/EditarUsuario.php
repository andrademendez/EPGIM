<?php

namespace App\Http\Livewire\User;

use App\Models\Campanias;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class EditarUsuario extends Component
{
    use WireToast, WithPagination;

    public $id_usuario, $name, $email, $password, $repeat_password, $status, $id_rol, $profile;
    public $open;

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }

    public function mount()
    {
        $user = User::find($this->id_usuario);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->id_rol = $user->id_rol;

        $this->profile = $user->profilePicture();
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'id_rol' => 'required'
        ]);

        try {
            $user = User::find($this->id_usuario);
            $user->name = $this->name;
            $user->id_rol = $this->id_rol;
            $user->save();
            if ($user) {
                toast()->success('Datos actualizados!!')->push();
            }
        } catch (\Throwable $th) {
            toast()->danger('Verica tus datos!!')->push();
        }
    }

    public function changeStatus()
    {
        # code...
        $user = User::find($this->id_usuario);
        if ($user->status) {
            $user->status = false;
        } else {
            $user->status = true;
        }
        $user->updated_at = now();
        $user->save();
        if ($user) {
            $this->status = $user->status;
            toast()->success('Se a cambiado el estatus del usuario!!')->push();
            $this->closeModal();
        }
    }
    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8',
            'repeat_password' => 'required|min:8'
        ]);

        try {
            if ($this->password == $this->repeat_password) {
                $user = User::find($this->id_usuario);
                $user->password = Hash::make($this->password);
                $user->save();
                if ($user) {
                    toast()->success('Contraseña ha sido actualizado!!')->push();
                    $this->reset(['password', 'repeat_password']);
                }
            } else {
                toast()->danger('Las contraseñas no coinciden!!')->push();
            }
        } catch (\Throwable $th) {
            toast()->danger('Verifique tus datos!!')->push();
        }
    }

    public function render()
    {
        return view('livewire.user.editar-usuario', [
            'roles' => Roles::all(),
            'role' => Roles::find($this->id_rol),
        ]);
    }
}