<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Campanias extends Model
{
    use HasFactory;

    protected $table = "campanias";

    public function dateFormato($fecha)
    {
        $date = new DateTime($fecha);
        $dateF = $date->format('Y-m-d');
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
}