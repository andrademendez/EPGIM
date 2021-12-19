<?php

namespace App\Http\Livewire;

use App\Models\Medios as ModelsMedios;
use Livewire\Component;

class Medios extends Component
{
    public $search = '', $open;
    public $nombre, $action;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $rules = [
        'nombre' => 'required',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset('nombre');
    }

    public function store()
    {
        # code...
    }
    public function render()
    {
        return view('livewire.medios', [
            'medios' => ModelsMedios::all()
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