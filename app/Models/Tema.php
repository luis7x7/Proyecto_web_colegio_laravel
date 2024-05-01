<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = "temas";
    protected $fillable = [
        'nombre'
    ];

    public function usuarios()
    {
        return $this->hasOne(Usuarios::class);
        //return $this->hasOne(Roles::class);
        //return $this->hasOne('App\Models\Usuarios', 'rol_id', 'id');
    }
}
