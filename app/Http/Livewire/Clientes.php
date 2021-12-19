<?php

namespace App\Http\Livewire;

use App\Models\Clientes as ModelsClientes;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $open, $action, $search = '';
    public $nombre, $contacto, $email, $telefono, $id_cliente;

    protected $rules = [
        'nombre' => 'required',
        'contacto' => 'required',
    ];

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openEdit()
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
        $this->reset(['nombre', 'contacto', 'telefono', 'email', 'id_cliente']);
    }

    public function store()
    {
        $this->validate();
        try {
            $cliente = new ModelsClientes();
            $cliente->nombre = $this->nombre;
            $cliente->contacto = $this->contacto;
            $cliente->email = $this->email;
            $cliente->telefono = $this->telefono;
            $cliente->save();
            if ($cliente) {
                $this->showAlert('Cliente Registrado', 'success');
                $this->closeModal();
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error del sistema!!', 'error');
        }
    }
    public function render()
    {
        return view('livewire.clientes', [
            'clientes' => ModelsClientes::where('nombre', 'LIKE', "%$this->search%")->paginate(10),
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