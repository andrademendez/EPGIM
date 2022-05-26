<?php

namespace App\Models\Operaciones;

use App\Models\Campanias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesServicios extends Model
{
    use HasFactory;

    protected $table = 'ordenes_servicios';


    public function actividad()
    {
        # code...
        return $this->belongsTo(Actividades::class);
    }


    public function campania()
    {
        # code...
        return $this->belongsTo(Campanias::class);
    }

    public function tipo_orden()
    {
        return $this->belongsTo(TiposOrdenes::class, 'tipo_orden_servicios_id');
    }
}