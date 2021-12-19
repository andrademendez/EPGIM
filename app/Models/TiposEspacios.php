<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposEspacios extends Model
{
    use HasFactory;

    protected $table = "tipos_espacios";
    protected $fillable = ['nombre'];

    public function espacios()
    {
        return $this->hasMany(Espacios::class);
    }
}