<?php

namespace App\Http\Livewire;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $email, $id_rol, $password, $repeat_password, $status, $id_user;
    public $search = '', $open, $action;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'id_rol' => 'required',
        'password' => 'required',
        'repeat_password' => 'required',
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
        $user = User::find($id);
        $this->id_user = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->id_rol = $user->id_rol;
        $this->status  = $user->status;
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['id_rol', 'name', 'email', 'action', 'password', 'repeat_password', 'id_user', 'status']);
    }

    public function updatePassword()
    {
        if ($this->password == $this->repeat_password) {
            $user = User::find($this->id_user);
            $user->password = Hash::make($this->password);
            $user->save();
            if ($user) {
                $this->showAlert('Contraseña actualizada!!', 'success');
            }
        } else {
            $this->showAlert('Las contraseña no coninciden', 'info');
        }
    }

    public function store()
    {
        $this->validate();
        try {
            if ($this->action == 'Registrar') {
                if ($this->password == $this->repeat_password) {
                    $user = new User();
                    $user->name = $this->name;
                    $user->email = $this->email;
                    $user->id_rol = $this->id_rol;
                    $user->password = Hash::make($this->password);
                    $user->status = true;
                    $user->save();
                    if ($user) {
                        $this->showAlert('Usuario registrado', 'success');
                        $this->closeModal();
                    }
                } else {
                    $this->showAlert('Las contraseña no coninciden', 'info');
                }
            } elseif ($this->action == 'Actualizar') {
                $user = User::find($this->id_user);
                $user->name = $this->name;
                $user->id_rol = $this->id_rol;
                $user->save();
                if ($user) {
                    $this->showAlert('Los datos del Usuario han sido actualizado', 'success');
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Verifique sus datos', 'info');
        }
    }

    public function render()
    {
        return view('livewire.usuarios', [
            'usuarios' => User::where('name', 'LIKE', "%$this->search%")
                ->orWhere('email', 'like', "%$this->search%")->paginate(10),
            'roles' => Roles::all(),
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