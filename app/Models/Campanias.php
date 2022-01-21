<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Campanias extends Model
{
    use HasFactory;

    protected $table = "campanias";
    protected $guarded = [];
    protected $fillable = ['title', 'start', 'end', 'status', 'hold', 'display'];


    public function dateFormato($fecha)
    {
        setlocale(LC_ALL, "es_ES");
        $date = new DateTime($fecha);
        $dateF = $date->format('Y-m-d');
        return $dateF;
    }

    public function formatoMx($fecha)
    {
        setlocale(LC_ALL, "es_ES");
        $date = new DateTime($fecha);
        $dateF = $date->format('d-M-Y');
        return $dateF;
    }

    public function espacios()
    {
        return $this->belongsToMany(Espacios::class, 'campania_espacio', 'id_campania', 'id_espacio');
    }

    public function medio()
    {
        return $this->belongsTo(Medios::class, 'id_medio');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public function bloqueos()
    {
        return $this->belongsToMany(Bloqueos::class, 'bloqueo_campania', 'id_campania', 'id_bloqueo');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function attachStatusFile()
    {
        return $this->hasOne(AttachStatusFiles::class, 'id_campania');
    }
}