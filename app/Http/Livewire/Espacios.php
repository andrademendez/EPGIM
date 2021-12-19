<?php

namespace App\Http\Livewire;

use App\Models\Espacios as ModelsEspacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use Livewire\Component;
use Livewire\WithPagination;

class Espacios extends Component
{
    use WithPagination;

    public $search = '', $open, $action;
    public $nombre, $referencia, $medidas, $cantidad, $precio, $id_unidad, $id_tipo, $id_ubicacion;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $rules = [
        'nombre' => 'required',
        'referencia' => 'required',
        'cantidad' => 'required',
        'id_unidad' => 'required',
        'id_tipo' => 'required',
        'id_ubicacion' => 'required',
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
        $this->reset(['nombre', 'referencia', 'medidas', 'cantidad', 'precio', 'id_unidad', 'id_tipo', 'id_ubicacion']);
    }

    public function store()
    {
        # code...
        $this->validate();
        try {
            $espacio = new ModelsEspacios;
            $espacio->nombre = $this->nombre;
            $espacio->referencia = $this->referencia;
            $espacio->medidas = $this->medidas;
            $espacio->cantidad = $this->cantidad;
            $espacio->precio = $this->precio;
            $espacio->estatus = true;
            $espacio->id_unidad_negocio = $this->id_unidad;
            $espacio->id_tipo_espacio = $this->id_tipo;
            $espacio->id_ubicacion = $this->id_ubicacion;
            $espacio->save();
            if ($espacio) {
                $this->showAlert('Espacio registrado!', 'success');
                $this->closeModal();
            } else {
                $this->showAlert('Verifica tus datos!', 'error');
            }
        } catch (\Throwable $th) {
            $this->showAlert('Verifica tus datos!', 'error');
        }
    }
    public function render()
    {
        return view('livewire.espacios', [
            'espacios' => ModelsEspacios::where('nombre', 'LIKE', "%$this->search%")->paginate(15),
            'ubicaciones' => Ubicacion::all(),
            'tipos' => TiposEspacios::all(),
            'unidades' => UnidadesNegocios::all(),
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