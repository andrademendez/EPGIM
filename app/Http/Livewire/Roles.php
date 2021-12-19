<?php

namespace App\Http\Livewire;

use App\Models\Roles as ModelsRoles;
use Livewire\Component;

class Roles extends Component
{
    public $open, $action, $search = '';

    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function openEdit()
    {
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.roles', [
            'roles' => ModelsRoles::all(),
        ]);
    }
}