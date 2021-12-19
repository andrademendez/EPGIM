<?php

namespace App\Http\Livewire;

use App\Models\UnidadesNegocios;
use Livewire\Component;

class Campanias extends Component
{
    public $open, $action, $search = '';
    public $unidad;

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

    public function render()
    {
        return view('livewire.campanias', [
            'unidades' => UnidadesNegocios::all()
        ]);
    }
}