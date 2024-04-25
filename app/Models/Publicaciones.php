<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'Sub_tema',
        'contenido',
        'imagen',
        'fecha_publicacion',
        'categoria_id',
        'tema_id',
        'usuario_id',
    ];

    //relacion inversa
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuarios');
        //return $this->belongsTo('App\Models\Publicacion', 'publicacion_id', 'id');
    }

    public function comentario()
    {
        return $this->hasMany('App\Models\Comentarios');
        //return $this->belongsTo('App\Models\Publicacion', 'publicacion_id', 'id');
    }
}
