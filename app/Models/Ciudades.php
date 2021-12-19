<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;

    protected $table = "ciudades";
    protected $fillable = ['clave', 'nombre'];

    public function unidades()
    {
        return $this->hasMany(UnidadesNegocios::class, 'id_ciudad');
    }
}