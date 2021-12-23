<?php

namespace App\Http\Livewire;

use App\Models\Campanias;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detalles extends Component
{
    public function render()
    {
        return view('livewire.detalles', [
            'campanias' => Campanias::where('id_user', '=', Auth::id())->get()
        ]);
    }
}