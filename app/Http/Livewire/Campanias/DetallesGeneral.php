<?php

namespace App\Http\Livewire\Campanias;

use App\Models\Campanias;
use Livewire\Component;

class DetallesGeneral extends Component
{
    public $campania_id;

    public function render()
    {
        return view(
            'livewire.campanias.detalles-general',
            [
                'campania' => Campanias::find($this->campania_id),
            ]
        );
    }
}