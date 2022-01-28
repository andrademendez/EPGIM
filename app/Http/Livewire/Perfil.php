<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class Perfil extends Component
{
    use WireToast, WithFileUploads;

    public $id_user;
    public $name, $email, $rol, $foto;
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
            toast()->warning('Revise sus datos!!')->push();
        }
    }

    public function changePerfil()
    {
        $this->validate([
            'foto' => 'image',
        ]);

        try {
            $user = User::find($this->id_user);
            if ($user->perfil == NULL) {
                $url = $this->foto->store('profile', 'public');
                $url = Storage::url($url);
                $user->perfil = $url;
                $user->save();
                if ($user) {
                    toast()->success('Perfil Actualizado!!')->push();
                    $this->reset('foto');
                }
            } else {
                $asPath = str_replace('storage', 'public', $user->perfil);
                Storage::delete($asPath);

                $url = $this->foto->store('profile', 'public');
                $url = Storage::url($url);
                $user->perfil = $url;
                $user->save();
                if ($user) {
                    $this->reset('foto');
                    toast()->success('Foto de Perfil Actualizado!!')->push();
                }
            }

            // $user->perfil = $this->foto;
            // $user->updated_at = now();
            // $user->save();
            // if ($user) {
            //     # code...
            // }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function render()
    {
        return view('livewire.perfil', [
            'perfil' => User::find($this->id_user),
        ]);
    }
}