<?php

namespace App\Http\Livewire;

use App\Models\TiposEspacios;
use Livewire\Component;
use Livewire\WithPagination;

class TipoEspacio extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $nombre, $open, $search = '', $id_tipo, $action;

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

    public function openEdit($id)
    {
        $this->open = true;
        $this->action = 'Actualizar';
        $tipo = TiposEspacios::find($id);
        $this->nombre = $tipo->nombre;
        $this->id_tipo = $tipo->id;
    }

    public function openDelete()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->reset('nombre', 'id_tipo');
    }

    public function render()
    {
        return view('livewire.tipo-espacio', [
            'tipos' => TiposEspacios::where('nombre', 'LIKE', "%$this->search%")->paginate(10),
        ]);
    }

    public function store()
    {
        $this->validate();
        try {
            if ($this->action == 'Registrar') {
                $tipo = new TiposEspacios();
                $tipo->nombre = $this->nombre;
                $tipo->save();
                if ($tipo) {
                    $this->showAlert('Tipo de espacio registrado', 'success');
                    $this->closeModal();
                }
            } else {
                $tipo = TiposEspacios::find($this->id_tipo);
                $tipo->nombre = $this->nombre;
                $tipo->save();
                if ($tipo) {
                    $this->showAlert('Tipo de espacio actualizado', 'success');
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            $this->showAlert('Registro no realizado', 'error');
        }
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