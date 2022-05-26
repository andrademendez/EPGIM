<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;


    public function campanias()
    {
        # code...
        return $this->hasMany(Campanias::class, 'id_cliente');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}