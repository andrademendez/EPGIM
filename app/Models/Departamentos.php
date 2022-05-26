<?php

namespace App\Models;

use App\Models\Operaciones\Actividades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = "departamentos";

    public function users()
    {
        # code...
        return $this->belongsToMany(User::class, 'departamento_user', 'departamento_id', 'user_id');
    }

    public function actividades()
    {
        return $this->belongsToMany(Actividades::class, 'actividad_departamento', 'actividad_id', 'departamento_id');
    }
}