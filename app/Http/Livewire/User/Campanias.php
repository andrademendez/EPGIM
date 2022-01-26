<?php

namespace App\Http\Livewire\User;

use App\Models\Campanias as ModelsCampanias;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Campanias extends Component
{
    use WithPagination;

    public $id_usuario;
    public function render()
    {
        return view('livewire.user.campanias', [
            'campanias' => ModelsCampanias::where('id_user', $this->id_usuario)
                ->orderBy('created_at', 'asc')
                ->paginate(10),

        ]);
    }
}