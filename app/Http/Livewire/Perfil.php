<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Perfil extends Component
{
    use WireToast;

    public $id_user;
    public $name, $email, $rol;
    public $password, $repeat_password;

    protected $rules = [
        'name' => 'required',
    ];

    public function mount()
    {
        $user = User::find($this->id_user);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->rol = $user->rol->nombre;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);
        try {
            $user = User::find($this->id_user);
            $user->name = $this->name;
            $user->save();
            if ($user) {
                $this->name = $user->name;
                toast()->success('Datos actualizados!!')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8',
            'repeat_password' => 'required|min:8',
        ]);
        try {
            if ($this->password == $this->repeat_password) {
                $user = User::find($this->id_user);
                $user->password = Hash::make($this->password);
                $user->save();
                if ($user) {
                    toast()->success('Contraseña actualizado!!')->push();
                    $this->reset(['password', 'repeat_password']);
                }
            } else {
                toast()->info('Las contraseñas no coinciden!!')->push();
                //$this->showAlert('Las contraseñas no coinciden', 'error');
            }
        } catch (\Throwable $th) {
            //toast()->error('Revise sus datos!!')->push();
            $this->showAlert('Revise sus datos', 'error');
        }
    }

    public function render()
    {
        return view('livewire.perfil', [
            'perfil' => User::find($this->id_user),
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