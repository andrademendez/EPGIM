<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class EditarUsuario extends Component
{
    public $id_usuario;

    public function render()
    {
        return view('livewire.editar-usuario', [
            'usuario' => User::find($this->id_usuario),
        ]);
    }
}