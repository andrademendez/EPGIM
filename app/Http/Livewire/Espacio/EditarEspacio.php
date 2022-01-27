<?php

namespace App\Http\Livewire\Espacio;

use App\Models\Campanias;
use App\Models\Espacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class EditarEspacio extends Component
{
    use WithPagination;
    use WireToast;

    public $id_espacio, $nombre, $referencia, $medidas, $cantidad, $precio, $estatus, $id_unidad, $id_tipo, $id_ubicacion;

    protected $rules = [
        'nombre' => 'required|min:4',
        'referencia' => 'required',
        'cantidad' => 'required|integer',
        'id_unidad' => 'required',
        'id_tipo' => 'required',
        'id_ubicacion' => 'required',
    ];


    public function mount()
    {
        $espacio = Espacios::find($this->id_espacio);
        $this->nombre = $espacio->nombre;
        $this->referencia = $espacio->referencia;
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
    public function render()
    {
        return view('livewire.espacio.editar-espacio', [
            'unidades' => UnidadesNegocios::all(),
            'tipos' => TiposEspacios::all(),
            'ubicaciones' => Ubicacion::all(),
            'campanias' => DB::table('campania_espacio')
                ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
                ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                ->join('users', 'users.id', '=', 'campanias.id_user')
                ->select('campanias.*', 'users.name as userName')
                ->where('espacios.id', '=', $this->id_espacio)
                ->orderBy('campanias.created_at', 'asc')
                ->paginate(10),
        ]);
    }
}