<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestacomentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'contenido',
        'fecha_respuesta',
        'usuario_id',
        'comentario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function comentario()
    {
        return $this->belongsTo(Comentarios::class);
    }
}
