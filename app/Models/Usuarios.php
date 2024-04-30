<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuarios extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "usuarios";

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
        'imagen_usuario'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function rol()
    {
        return $this->belongsTo(Roles::class);
        //return $this->hasOne(Roles::class);
        // return $this->belongsTo('App\Models\Roles', 'rol_id', 'id');
    }

    //relacion de uno a muchos
    public function publicacion()
    {
        return $this->hasMany('App\Models\Publicaciones');
        //return $this->belongsTo('App\Models\Publicacion', 'publicacion_id', 'id');
    }

    //relacion de uno a muchos
    public function comentario()
    {
        return $this->hasMany('App\Models\Comentarios');
        //return $this->belongsTo('App\Models\Publicacion', 'publicacion_id', 'id');
    }
}
