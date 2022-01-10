<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloqueos extends Model
{
    use HasFactory;

    protected $table = "bloqueos";

    public function campanias()
    {
        return $this->belongsToMany(Campanias::class, 'bloqueo_campania', 'id_bloqueo', 'id_campania');
    }
}