<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesNegocios extends Model
{
    use HasFactory;

    protected $table = "unidades_negocios";
    protected $fillable = ['nombre', 'id_ciudad'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'id_ciudad');
    }

    public function espacios()
    {
        return $this->hasMany(Espacios::class);
    }
}