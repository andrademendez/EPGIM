<?php

namespace App\Http\Livewire;

use App\Models\Campanias;
use App\Models\Espacios as ModelsEspacios;
use App\Models\TiposEspacios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\This;
use Usernotnull\Toast\Concerns\WireToast;

class Espacios extends Component
{
    use WithPagination;
    use WireToast;

    public $search = '', $open, $action, $search_unidad;
    public $id_espacio, $nombre, $referencia, $clave, $medidas, $cantidad, $precio, $id_unidad, $id_tipo, $id_ubicacion;

    protected $queryString = [
        'search' => ['except' => '']
    ];
    protected $listeners = ['reloadPage'];

    protected $rules = [
        'nombre' => 'required',
        'referencia' => 'required',
        'clave' => 'required',
        'cantidad' => 'required|integer',
        'id_unidad' => 'required',
        'id_tipo' => 'required',
        'id_ubicacion' => 'required',
    ];

    public function reloadPage()
    {
        # code...
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }
    public function openEdit()
    {
        $this->open = true;
    }

    public function openDelete($id)
    {
        $this->open = true;
        $this->action = 'Eliminar';
        $this->id_espacio = $id;
    }


    public function delete()
    {
        try {
            $campanias = DB::table('campania_espacio')
                ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
                ->select('espacios.id')
                ->where('espacios.id', '=', $this->id_espacio)
                ->get();
            if ($campanias->count() == 0) {
                $espacio = ModelsEspacios::find($this->id_espacio);
                $espacio->delete();
                if ($espacio) {
                    $this->reset('id_espacio');
                    $this->open = false;
                    toast()->success('Espacio Eliminado')->push();
                }
            } else {
                toast()->warning('No se puede eliminar espacio hay dpendencias activas')->push();
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->warning('Error del sistema')->push();
        }
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
            $espacio->clave = $this->clave;
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

    public function deshabilitar($id)
    {
        # code...
        $espacio = ModelsEspacios::find($id);
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
        return view('livewire.espacios', [
            'espacios' => ModelsEspacios::where(
                [
                    ['nombre', 'LIKE', "%$this->search%"],
                    ['id_unidad_negocio', 'LIKE', "%$this->search_unidad%"]
                ]
            )->paginate(15),
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