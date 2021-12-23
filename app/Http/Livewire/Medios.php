<?php

namespace App\Http\Livewire;

use App\Models\Medios as ModelsMedios;
use Livewire\Component;

class Medios extends Component
{
    public $search = '', $open;
    public $nombre, $action, $id_medio;

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
        $this->reset(['nombre', 'id_medio']);
    }

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $medio = ModelsMedios::find($id);
        $this->nombre = $medio->nombre;
        $this->id_medio = $medio->id;
    }

    public function openDelete()
    {
        $this->open = true;
        $this->action = 'Eliminar';
    }
    public function store()
    {
        try {
            if ($this->action == 'Registrar') {
                $medio = new ModelsMedios;
                $medio->nombre = $this->nombre;
                $medio->save();
                if ($medio) {
                    $this->showAlert('Medio registrado!!', 'success');
                }
            } else {
                $medio = ModelsMedios::find($this->id_medio);
                $medio->nombre = $this->nombre;
                $medio->save();
                if ($medio) {
                    $this->showAlert('Medio registrado!!', 'success');
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error verifique tus datos!!', 'error');
        }
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