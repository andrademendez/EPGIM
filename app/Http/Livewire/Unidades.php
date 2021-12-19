<?php

namespace App\Http\Livewire;

use App\Models\Ciudades;
use App\Models\UnidadesNegocios;
use Livewire\Component;

class Unidades extends Component
{
    public $open;
    public $buscar = '';
    public $action;
    public $id_ciudad, $nombre;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    protected $rules = [
        'nombre' => 'required',
        'id_ciudad' => 'required',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['id_ciudad', 'nombre']);
    }

    public function openEdit()
    {
        $this->open = true;
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function store()
    {
        $this->validate();

        $unidad = new UnidadesNegocios();
        $unidad->nombre = $this->nombre;
        $unidad->id_ciudad = $this->id_ciudad;
        $unidad->save();
        if ($unidad) {
            $this->showAlert('Registro exitóso', 'success');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.unidades', [
            'unidades' => UnidadesNegocios::where('nombre', 'LIKE', "%$this->buscar%")->get(),
            'ciudades' => Ciudades::all(),
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