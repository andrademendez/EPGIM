<?php

namespace App\Http\Livewire;

use App\Models\Campanias;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Detalles extends Component
{

    use WithPagination;

    public $search = '', $open, $action;

    protected $queryString = [
        'search' => ['except' => '']
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

    public function render()
    {
        return view('livewire.detalles', [
            'campanias' => Campanias::where(
                [
                    ['id_user', '=', Auth::id()],
                    ['title', 'LIKE', "%$this->search%"]
                ]
            )->paginate(15)
        ]);
    }
}