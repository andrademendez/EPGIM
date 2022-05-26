<?php

namespace App\Http\Livewire;

use App\Models\Clientes as ModelsClientes;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Clientes extends Component
{
    use WithPagination, WireToast;
    use AuthorizesRequests;

    public $open, $action, $search = '', $searchUser = "";
    public $nombre, $contacto, $email, $telefono, $id_cliente, $usuario;

    protected $rules = [
        'nombre' => 'required|min:4',
        'contacto' => 'required',
        'telefono' => 'nullable|size:10',
        'email' => 'nullable|email:rfc,dns',
        'usuario' => 'required',
    ];

    protected $queryString = [
        'search' => ['except' => '']
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $cliente = ModelsClientes::find($id);
        $this->id_cliente = $cliente->id;
        $this->usuario = $cliente->id_user;
        $this->nombre = $cliente->nombre;
        $this->email = $cliente->email;
        $this->telefono = $cliente->telefono;
        $this->contacto = $cliente->contacto;
    }


    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'contacto', 'telefono', 'email', 'id_cliente', 'usuario']);
    }

    public function store()
    {
        $this->validate();
        try {
            if ($this->action == 'Registrar') {
                $cliente = new ModelsClientes();
                $cliente->nombre = $this->nombre;
                $cliente->contacto = $this->contacto;
                $cliente->email = $this->email;
                $cliente->telefono = $this->telefono;
                $cliente->id_user = $this->usuario;
                $cliente->save();
                if ($cliente) {
                    toast()->success('Cliente Registrado!!')->push();
                    //$this->showAlert('Cliente Registrado', 'success');
                    $this->closeModal();
                }
            } else {
                $cliente = ModelsClientes::find($this->id_cliente);
                $cliente->nombre = $this->nombre;
                $cliente->email = $this->email;
                $cliente->telefono = $this->telefono;
                $cliente->contacto = $this->contacto;
                $cliente->save();
                if ($cliente) {
                    toast()->success('Datos del cliente actualizados!!')->push();
                    //$this->showAlert('Datos del cliente actualizados!!', 'success');
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error del sistema!!', 'error');
        }
    }

    public function openDelete($id)
    {
        $this->open = true;
        $this->id_cliente = $id;
        $this->action = 'Eliminar';
    }

    public function delete()
    {
        try {
            $cliente = ModelsClientes::find($this->id_cliente);
            $campanias = DB::table('campanias')->where('id_cliente', $this->id_cliente)->get();
            if ($campanias->count() == 0) {
                # code...
                $dep = $cliente->delete();
                if ($dep) {
                    toast()->success('Cliente Eliminado!!')->push();
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function render()
    {
        return view('livewire.clientes', [
            'clientes' => ModelsClientes::where([
                ['nombre', 'LIKE', "%$this->search%"],
                ['id_user', 'LIKE', "%$this->searchUser%"],
            ])->paginate(15),
            'users' => User::where('id_rol', 2)->get(),
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