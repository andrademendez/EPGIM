<?php

namespace App\Http\Livewire\Espacio;

use App\Models\Espacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use Livewire\Component;

class EditarEspacio extends Component
{
    public $id_espacio, $nombre, $referencia, $medidas, $cantidad, $precio, $estatus, $id_unidad, $id_tipo, $id_ubicacion;

    public function mount()
    {
        $espacio = Espacios::find($this->id_espacio);
        $this->nombre = $espacio->nombre;
        $this->referencia = $espacio->referencia;
        $this->medidas = $espacio->medidas;
        $this->cantidad = $espacio->cantidad;
        $this->precio = '$ ' . $espacio->precio;
        $this->estatus = $espacio->estatus;
        $this->id_unidad = $espacio->id_unidad_negocio;
        $this->id_tipo = $espacio->id_tipo_espacio;
        $this->id_ubicacion = $espacio->id_ubicacion;
    }
    public function render()
    {
        return view('livewire.espacio.editar-espacio', [
            'unidades' => UnidadesNegocios::all(),
            'tipos' => TiposEspacios::all(),
            'ubicaciones' => Ubicacion::all(),
        ]);
    }
}