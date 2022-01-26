<?php

namespace App\Http\Livewire;

use App\Models\Campanias;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Usuarios extends Component
{
    use WithPagination, WithFileUploads;
    use WireToast, AuthorizesRequests;

    public $name, $email, $id_rol, $password, $repeat_password, $status, $id_user;
    public $search = '', $open, $interno, $action;

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
        $this->action = 'registrar';
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
        $this->reset(['id_rol', 'name', 'email', 'password', 'repeat_password', 'id_user', 'interno', 'status', 'action']);
    }

    public function delete()
    {
        # code...
        try {
            $campanias = Campanias::where('id_user', $this->id_user)->count();
            if ($campanias > 0) {

                $this->showAlert('El Usuario tiene eventos activos', 'info');
                $this->closeModal();
            } else {
                $user = User::find($this->id_user);
                $delete = $user->forceDelete();
                if ($delete) {
                    $this->showAlert('El Usuario ha sido eliminado del sistema', 'success');
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
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
                    toast()->success('Usuario creado!!')->push();
                    $this->closeModal();
                }
            } else {
                toast()->info('Las contraseña no coninciden!!')->push();
                //$this->showAlert('Las contraseña no coninciden', 'info');
            }
        } catch (\Throwable $th) {
            $this->showAlert('Verifique sus datos', 'info');
        }
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        if ($user->id != Auth::id()) {
            if ($user->status == 0) {
                $user->status = true;
            } else {
                $user->status = false;
            }
            $user->save();
            if ($user) {
                toast()
                    ->success('Estatus actualizado!!')
                    ->push();
            }
        } else {
            toast()
                ->info('He hombre no te puedes deshabilitar!!')
                ->push();
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