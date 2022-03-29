<?php

namespace App\Http\Livewire\Inicio;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MejoresClientes extends Component
{
    public function render()
    {
        return view('livewire.inicio.mejores-clientes', [
            'clientes' => DB::table('campania_espacio')
                ->join('espacios', 'campania_espacio.id_espacio', '=', 'espacios.id')
                ->join('campanias', 'campania_espacio.id_campania', '=', 'campanias.id')
                ->join('clientes', 'campanias.id_cliente', '=', 'clientes.id')
                ->selectRaw('clientes.nombre as cliente, count(campanias.id) as total, sum(espacios.precio) as importe')
                ->where('campanias.start', '<=', now())
                ->whereIn(
                    'campanias.status',
                    ['Confirmado', 'Cerrado']
                )
                ->groupBy('clientes.id')
                ->orderBy('total', 'desc')
                ->limit(10)->get()
        ]);
    }
}