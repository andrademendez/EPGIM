<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\Operaciones\OrdenesServicios;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Ordenes extends Component
{
    use WithPagination;

    public $search;
    public $id_cliente, $id_actividad, $situacion;

    protected $queryString = [
        'search' => ['except' => '']
    ];


    public function render()
    {
        return view('livewire.operaciones.ordenes', [
            'ordenes' => OrdenesServicios::paginate(15),
            'usuario' => User::find(Auth::id()),
        ]);
    }
}