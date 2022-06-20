<?php

namespace App\Models\Operaciones;

use App\Models\Campanias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected  $table = "cotizaciones";

    public function campania()
    {
        # code...
        return  $this->belongsTo(Campanias::class, 'campania_id');
    }
}