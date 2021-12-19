<?php

namespace App\Http\Livewire;

use App\Models\Ciudades as ModelsCiudades;
use Livewire\Component;
use Livewire\WithPagination;

class Ciudades extends Component
{
    use WithPagination;

    public $open;
    public $buscar = '';
    public $clave, $nombre;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    protected $rules = [
        'nombre' => 'required',
        'clave' => 'required',
    ];

    public function openModal()
    {
        $this->open = true;
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
        $this->reset(['clave', 'nombre']);
    }
    public function store()
    {
        $this->validate();

        $city = new ModelsCiudades();
        $city->clave = $this->clave;
        $city->nombre = $this->nombre;
        $city->save();
        if ($city) {
            $this->showAlert('Registro exitóso', 'success');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.ciudades', [
            'ciudades' => ModelsCiudades::where('nombre', 'LIKE', "%$this->buscar%")
                ->orderBy('clave', 'asc')
                ->paginate(10),
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