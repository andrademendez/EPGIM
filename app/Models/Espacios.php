<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacios extends Model
{
    use HasFactory;

    protected $table = "espacios";
    protected $fillable = ['nombre', 'referencia', 'medidas', 'cantidad', 'precio', 'estatus'];

    public function unidad()
    {
        return $this->belongsTo(UnidadesNegocios::class, 'id_unidad_negocio');
    }

    public function tipo()
    {
        return $this->belongsTo(TiposEspacios::class, 'id_tipo_espacio');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function campanias()
    {
        return $this->belongsToMany(Campanias::class, 'campania_espacio', 'id_espacio', 'id_campania');
    }
}