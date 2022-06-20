<?php

namespace App\Models;

use App\Models\Operaciones\OrdenesServicios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesServiciosEstatus extends Model
{
    use HasFactory;

    protected $table = "ordenes_servicios_estatus";

    public function orden()
    {
        return $this->belongsTo(OrdenesServicios::class, 'orden_servicio_id');
    }
}