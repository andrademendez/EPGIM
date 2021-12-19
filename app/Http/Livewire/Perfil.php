<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Perfil extends Component
{
    public $id_user;
    public $name, $email;
    public $password, $repeat_password;

    protected $rules = [
        'name' => 'required',
    ];

    public function mount()
    {
        $user = User::find($this->id_user);
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function update()
    {
        # code...
    }
    public function updatePassword()
    {
        try {
            if ($this->password == $this->repeat_password) {
                $user = User::find($this->id_user);
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