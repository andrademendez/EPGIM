<?php

namespace App\Http\Livewire\Espacio;

use App\Models\Campanias;
use App\Models\Espacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class EditarEspacio extends Component
{
    use WithPagination;
    use WireToast;

    public $id_espacio, $nombre, $referencia, $clave, $medidas, $cantidad, $precio, $estatus, $id_unidad, $id_tipo, $id_ubicacion;

    public $filterFecha = "todo";

    protected $rules = [
        'nombre' => 'required|min:4',
        'referencia' => 'required',
        'clave' => 'required',
        'cantidad' => 'required|integer',
        'precio' => 'nullable|integer',
        'id_unidad' => 'required',
        'id_tipo' => 'required',
        'id_ubicacion' => 'required',
    ];

    protected $listeners = ['reloadPage' => 'mount'];

    public function mount()
    {
        $espacio = Espacios::find($this->id_espacio);
        $this->nombre = $espacio->nombre;
        $this->referencia = $espacio->referencia;
        $this->clave = $espacio->clave;
        $this->medidas = $espacio->medidas;
        $this->cantidad = $espacio->cantidad;
        $this->precio = $espacio->precio;
        $this->estatus = $espacio->estatus;
        $this->id_unidad = $espacio->id_unidad_negocio;
        $this->id_tipo = $espacio->id_tipo_espacio;
        $this->id_ubicacion = $espacio->id_ubicacion;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $espacio = Espacios::find($this->id_espacio);
        $espacio->nombre = $this->nombre;
        $espacio->clave = $this->clave;
        $espacio->referencia = $this->referencia;
        $espacio->medidas = $this->medidas;
        $espacio->cantidad = $this->cantidad;
        $espacio->precio = $this->precio;
        $espacio->estatus = $this->estatus;
        $espacio->id_unidad_negocio = $this->id_unidad;
        $espacio->id_tipo_espacio = $this->id_tipo;
        $espacio->id_ubicacion = $this->id_ubicacion;
        $espacio->save();
        if ($espacio) {
            toast()->success('Datos actualizados!!')->push();
            $this->mount();
        }
    }

    public function deshabilitar($id)
    {
        # code...
        $espacio = Espacios::find($id);
        if ($espacio->estatus == true) {
            $espacio->estatus = false;
            $espacio->save();

            if ($espacio) {
                toast()->success('Espacio deshabilitado!!')->push();
                $this->emit('reloadPage');
            }
        } else {
            $espacio->estatus = true;
            $espacio->save();

            if ($espacio) {
                toast()->success('Espacio habilitado!!')->push();
                $this->emit('reloadPage');
            }
        }
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