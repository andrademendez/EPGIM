<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    //Interior o exterior
    protected $table = "ubicaciones_espacios";

    public function espacios()
    {
        return $this->hasMany(Espacios::class);
    }
}