<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'fecha_comentario',
        'usuario_id',
        'publicacion_id',
        
    ];

    //relacion inversa
    /* public function usuario()
    {
        return $this->belongsTo('App\Models\Usuarios');
        //return $this->belongsTo('App\Models\Publicacion', 'publicacion_id', 'id');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Models\Comentarios');
    }

    public function comentarioPadre()
    {
        return $this->belongsTo('App\Models\Comentarios');
    }


    public function publicacion()
    {
        return $this->belongsTo('App\Models\Publicaciones');
    }*/

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicaciones::class);
    }

    public function respuestas()
    {
        return $this->hasMany(RespuestaComentario::class);
    }
}
