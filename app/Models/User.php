<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'contraseña',
        'telefono',
        'Tipo_Doc',
        'documento',
        'id_rol',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    // Para que Laravel use el campo correcto de contraseña
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}
