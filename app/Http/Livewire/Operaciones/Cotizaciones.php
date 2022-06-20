<?php

namespace App\Http\Livewire\Operaciones;


use App\Models\Operaciones\Cotizacion as OperacionesCotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class Cotizaciones extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.operaciones.cotizaciones', [
            'cotizaciones' => OperacionesCotizacion::paginate(15),
        ]);
    }
}