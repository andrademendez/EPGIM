<?php

namespace App\Models;

use App\Models\Operaciones\Actividades;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'id_rol');
    }

    public function profilePicture()
    {
        if ($this->perfil) {
            return $this->perfil;
        }

        return  asset('images/logo.png');
    }


    public function isAdmin()
    {
        return $this->id_rol == 1;
    }


    public function isCreator()
    {
        return $this->id_rol == 2;
    }

    public function isMonitor()
    {
        return $this->id_rol == 3;
    }

    public function isValidator()
    {
        return $this->id_rol == 4;
    }

    public function isAdminCierre()
    {
        return $this->id_rol == 5;
    }

    //end roles
    //start relationship
    public function campanias()
    {
        # code...
        return $this->hasMany(Campanias::class);
    }

    public function clientes()
    {
        # code...
        return $this->hasMany(Clientes::class);
    }

    public function departamentos()
    {
        # code...
        return $this->belongsToMany(Departamentos::class, 'departamento_user', 'departamento_id', 'user_id');
    }

    public function actividades()
    {
        # code...
        return $this->belongsToMany(Actividades::class, 'actividad_usuario', 'actividad_id', 'user_id');
    }
}