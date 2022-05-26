<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function ocupacion($id)
    {
        # code...
        $total = 0;

        $campanias = DB::table('campania_espacio')
            ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->selectRaw("count(*) as total, espacios.nombre")
            ->whereIn('campanias.status', ['Confirmado', 'Cerrado'])
            ->where('espacios.id', '=', $id)
            ->groupBy('espacios.nombre')
            ->get();
        foreach ($campanias as $key => $campania) {
            # code...
            $total = $campania->total;
        }
        //dd($campania->total);
        return $total;
    }
}