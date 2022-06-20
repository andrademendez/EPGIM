<?php

namespace App\Models;

use DateTime;
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

    protected function formatDate($date)
    {
        $fecha = new DateTime($date);
        $l = $fecha->format('Y-m-d');
        return $l;
    }

    public function diasTotales($id)
    {
        # code...
        $dias = DB::table('campanias')->selectRaw('TIMESTAMPDIFF(DAY,start, end) AS days')->where('id', '=', $id)->first();
        return $dias->days + 1;
    }

    public static function diasCosto($espacio_id, $campania)
    {
        # code...
        $dias = DB::table('campanias')->selectRaw('TIMESTAMPDIFF(DAY,start, end) AS days')->where('id', '=', $campania)->first();
        $espacio = Espacios::find($espacio_id);
        $total = ($espacio->precio * ($dias->days + 1)) / 30;

        return $total;
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