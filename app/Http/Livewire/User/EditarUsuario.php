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
        try {
            $user = User::find($this->id_usuario);
            $user->name = $this->name;
            $user->id_rol = $this->id_rol;
            $user->save();
            if ($user) {
                $this->showAlert('Datos actualizados', 'success');
            }
        } catch (\Throwable $th) {
            $this->showAlert('Problemas con la aplicacion', 'error');
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
            toast()
                ->success('Se a cambiado el estatus del usuario!!')
                ->push();
            $this->closeModal();
        }
    }
    public function updatePassword()
    {
        try {
            if ($this->password == $this->repeat_password) {
                $user = User::find($this->id_usuario);
                $user->password = Hash::make($this->password);
                $user->save();
                if ($user) {
                    $this->showAlert('Contraseña ha sido actualizado!!', 'success');
                    $this->reset(['password', 'repeat_password']);
                }
            } else {
                $this->showAlert('Las contraseñas no coinciden', 'error');
            }
        } catch (\Throwable $th) {
            $this->showAlert('Revise sus datos', 'error');
        }
    }

    public function render()
    {
        return view('livewire.user.editar-usuario', [
            'roles' => Roles::all(),
            'role' => Roles::find($this->id_rol),
        ]);
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