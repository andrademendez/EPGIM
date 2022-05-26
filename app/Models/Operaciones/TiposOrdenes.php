<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposOrdenes extends Model
{
    use HasFactory;

    protected $table = "tipo_orden_servicios";

    public function orden()
    {
        # code...
        return $this->hasOne(OrdenesServicios::class, 'tipo_orden_servicios_id');
    }
}