<?php

namespace App\Http\Livewire\Espacio;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Campanias extends Component
{
    use WithPagination;

    public $filterFecha = "todo", $id_espacio;

    public function render()
    {
        if ($this->filterFecha == 'activas') {
            $where = ['end', '>=', now()];
        } elseif ($this->filterFecha == 'pendientes') {

            $where = ['start', '>', now()];
        } elseif ($this->filterFecha == 'vencidas') {

            $where = ['end', '<', now()];
        } else {
            $where = ['end', 'LIKE', "%%"];
        }

        return view(
            'livewire.espacio.campanias',
            [
                'campanias' => DB::table('campania_espacio')
                    ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
                    ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                    ->join('users', 'users.id', '=', 'campanias.id_user')
                    ->select('campanias.*', 'users.name as userName')
                    ->where([
                        ['espacios.id', '=', $this->id_espacio],
                        $where
                    ])
                    ->orderBy('campanias.created_at', 'asc')
                    ->paginate(10),
            ]
        );
    }
}