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
