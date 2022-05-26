<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\RazonSocial as ModelsRazonSocial;
use Livewire\Component;

class RazonSocial extends Component
{
    public $open, $action, $search = '';
    public $razon, $direccion, $estado, $telefono, $municipio, $cp, $regimen;


    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $cliente = ModelsRazonSocial::find($id);
    }


    public function closeModal()
    {
        $this->open = false;
        $this->reset(['razon', 'direccion', 'estado', 'telefono', 'municipio', 'cp', 'regimen', 'action']);
    }

    public function render()
    {
        return view('livewire.operaciones.razon-social');
    }
}