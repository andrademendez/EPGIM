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
    public $search = '', $open, $interno;

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
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['id_rol', 'name', 'email', 'password', 'repeat_password', 'id_user', 'interno', 'status']);
    }

    public function store()
    {
        $this->validate();
        try {
            if ($this->password == $this->repeat_password) {
                $user = new User();
                $user->name = $this->name;
                $user->email = $this->email;
                $user->id_rol = $this->id_rol;
                $user->password = Hash::make($this->password);
                $user->status = true;
                $user->interno = $this->interno;
                $user->save();
                if ($user) {
                    $this->showAlert('Usuario registrado', 'success');
                    $this->closeModal();
                }
            } else {
                $this->showAlert('Las contraseña no coninciden', 'info');
            }
        } catch (\Throwable $th) {
            $this->showAlert('Verifique sus datos', 'info');
        }
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        if ($user->status == 0) {
            $user->status = true;
        } else {
            $user->status = false;
        }
        $user->save();
        if ($user) {
            $this->showAlert('Estatus cambiado', 'success');
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