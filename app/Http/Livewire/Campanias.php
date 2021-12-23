<?php

namespace App\Http\Livewire;

use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use Livewire\Component;

class Campanias extends Component
{
    public $open, $action, $search = '';
    public $unidad = 'general', $nombre, $estatus, $tipo, $start, $end, $cliente, $espacio, $id_campania;

    protected $listeners = [
        'openModalEvent' => 'openModal'
    ];
    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }


    public function closeModal()
    {
        $this->open = false;
        $this->reset(['nombre', 'estatus', 'tipo', 'start', 'end', 'cliente', 'espacio', 'id_campania']);
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
            'unidades' => UnidadesNegocios::all(),
            'medios' => Medios::all(),
            'clientes' => Clientes::all(),
            'espacios' => Espacios::all(),
        ]);
    }
}