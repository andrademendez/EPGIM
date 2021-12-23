<?php

namespace App\Http\Livewire;

use App\Models\Ciudades as ModelsCiudades;
use Livewire\Component;
use Livewire\WithPagination;

class Ciudades extends Component
{
    use WithPagination;

    public $open;
    public $buscar = '', $action;
    public $clave, $nombre, $id_ciudad;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    protected $rules = [
        'nombre' => 'required',
        'clave' => 'required',
    ];

    public function mount()
    {
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
        $city = ModelsCiudades::find($id);
        $this->id_ciudad = $city->id;
        $this->nombre = $city->nombre;
        $this->clave = $city->clave;
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['clave', 'nombre', 'id_ciudad']);
    }
    public function store()
    {
        $this->validate();
        try {
            if ($this->action == 'Registrar') {
                $city = new ModelsCiudades();
                $city->clave = $this->clave;
                $city->nombre = $this->nombre;
                $city->save();
                if ($city) {
                    $this->showAlert('Registro exitóso', 'success');
                    $this->closeModal();
                }
            } else {
                $city = ModelsCiudades::find($this->id_ciudad);
                $city->clave = $this->clave;
                $city->nombre = $this->nombre;
                $city->save();
                if ($city) {
                    $this->showAlert('Datos actualizados!!', 'success');
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error del sistema!!', 'error');
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