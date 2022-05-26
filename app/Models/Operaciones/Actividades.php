<?php

namespace App\Models\Operaciones;

use App\Models\Departamentos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;

    protected $table = 'actividades';


    public function orden_servicio()
    {
        return $this->hasOne(OrdenesServicios::class);
    }

    public function departamentos()
    {
        # code...
        return $this->belongsToMany(Departamentos::class, 'actividad_departamento', 'actividad_id', 'departamento_id');
    }
}