<?php

namespace App\Models\Operaciones;

use App\Models\Campanias;
use App\Models\Espacios;
use App\Models\OrdenesServiciosEstatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdenesServicios extends Model
{
    use HasFactory;

    protected $table = 'ordenes_servicios';


    public function actividad()
    {
        return $this->belongsTo(Actividades::class);
    }


    public function campania()
    {
        return $this->belongsTo(Campanias::class);
    }

    public function validacion()
    {
        return $this->hasOne(OrdenesServiciosEstatus::class, 'orden_servicio_id');
    }

    public function tipo_orden()
    {
        return $this->belongsTo(TiposOrdenes::class, 'tipo_orden_servicios_id');
    }

    public function responsables($id)
    {
        # code...
        $res = Actividades::find($id);

        return $res->departamentos;
    }

    public function espacios($id)
    {
        # code...
        $esp = Espacios::find($id);
        return $esp;
    }
}