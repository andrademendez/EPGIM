<?php

namespace App\Models;

use App\Models\Operaciones\Actividades;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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

    //
    //Roles de los usuarios
    //

    public function isAdmin()
    {
        $rol = Roles::find($this->id_rol);

        return $rol->clave == 'ieL6gwrVQLqzq1ypzjA5C2uZ';
    }


    public function isCreator()
    {
        $rol = Roles::find($this->id_rol);

        return $rol->clave == '3p3cVvRtBgC8xSQYjOqnSoDY';
    }

    public function isMonitor()
    {
        $rol = Roles::find($this->id_rol);

        return $rol->clave == 'i4rmIMlhO1RJaQePLs6sa1dc';
    }

    public function isValidator()
    {
        $rol = Roles::find($this->id_rol);

        return $rol->clave == 'zNY9upssqQtZDCQ6JSttazGV';
    }

    public function isAdminSO()
    {
        $rol = Roles::find($this->id_rol);

        return $rol->clave == '8fPrnAXGzMjfWs8o2LOSb2cQ';
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

    // usuario para validacion de ordenes de servicios
    public function isValidador($id)
    {
        $user = DB::table('departamento_user')->where('user_id', $id)->first();

        return $user->validador;
    }
}