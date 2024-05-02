<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\Publicaciones;
use App\Models\Roles;
use App\Models\Tema;

use App\Models\Usuarios;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        //temas
        $temas = [
            'Ejemplos',
            'Educación',
            'Vida Social',
            'Tecnología',
            'Deportes',
            'Cultura',
            'Salud',
            'Entretenimiento',
            'Política',
            'Negocios',
            'Viajes',
            'Medio Ambiente',
            'Arte',
            'Ciencia',
            'Moda',
            'Historia',
            'Religión',
            'Alimentación',
            'Música',
            'Literatura',
        ];

        foreach ($temas as $tema) {
            Tema::create([
                'nombre' => $tema,
            ]);
        }
        //categorias

        Categorias::Create([
            'nombre' => 'Noticias',
        ]);
        Categorias::Create([
            'nombre' => 'Avisos',
        ]);
        Categorias::Create([
            'nombre' => 'Eventos',
        ]);
        //roles
        Roles::create([
            'nombre' => 'Personal Administrativo',
        ]);

        Roles::create([
            'nombre' => 'Estudiante',
        ]);
        Roles::create([
            'nombre' => 'Profesor',
        ]);

        Roles::create([
            'nombre' => 'Obrero',
        ]);


        $usuarios = [
            [
                'nombre' => 'luis',
                'email' => 'luis@gmail.com',
                'password' => 'luis12345',
                'rol_id' => 1,
                'imagen_usuario' => 'default_user_image.jpg',
            ],
            [
                'nombre' => 'huasaca',
                'email' => 'huasaca@gmail.com',
                'password' => 'huasaca12345',
                'rol_id' => 1,
                'imagen_usuario' => 'huasaca.jpeg',
            ],
            [
                'nombre' => 'pinillos',
                'email' => 'pinillos@gmail.com',
                'password' => 'pinillos12345',
                'rol_id' => 1,
                'imagen_usuario' => 'pinillos.jpeg',
            ],
            [
                'nombre' => 'boris',
                'email' => 'boris@gmail.com',
                'password' => 'boris12345',
                'rol_id' => 3,
                'imagen_usuario' => 'boris.jpeg',
            ],
            [
                'nombre' => 'hualca',
                'email' => 'hualca@gmail.com',
                'password' => 'hualca12345',
                'rol_id' => 3,
                'imagen_usuario' => 'hualca.jpeg',
            ],
        ];

        foreach ($usuarios as $usuarioData) {
            Usuarios::create([
                'nombre' => $usuarioData['nombre'],
                'email' => $usuarioData['email'],
                'password' => Hash::make($usuarioData['password']),
                'rol_id' => $usuarioData['rol_id'],
                'imagen_usuario' => $usuarioData['imagen_usuario'],
            ]);
        }

        //publicaciones

        $publicaciones = [
            [
                'titulo' => 'Amor de la mi vida',
                'Sub_tema' => 'Romance',
                'contenido' => 'Todo sobre el amor',
                'imagen' => 'xxx',
                'fecha_publicacion' => '',
                'categoria_id' => '1',
                'tema_id' => '1',
                'usuario_id' => '1',
            ],

        ];

        foreach ($publicaciones as $publicacionesData) {
            Publicaciones::create([
                'titulo' => $publicacionesData['titulo'],
                'Sub_tema' => $publicacionesData['Sub_tema'],
                'contenido' => $publicacionesData['contenido'],
                'imagen' => $publicacionesData['imagen'],
                'fecha_publicacion' => Carbon::now('America/Lima'),
                'categoria_id' => $publicacionesData['categoria_id'],
                'tema_id' => $publicacionesData['tema_id'],
                'usuario_id' => $publicacionesData['usuario_id'],

            ]);
        }

        //comentarios
        $comentarios = [
            [
                'contenido'  => 'Todo se acaba',
                'fecha_comentario' => '',
                'usuario_id' => '1',
                'publicacion_id' => '1',
                'comentario_padre_id' => '',
            ],

            [
                'contenido'  => 'Todo se acabwwa',
                'fecha_comentario' => '',
                'usuario_id' => '1',
                'publicacion_id' => '1',
                'comentario_padre_id' => '1',
            ],
        ];

        foreach ($comentarios as $comentariosData) {
            Comentarios::create([
                'contenido' => $comentariosData['contenido'],
                'fecha_comentario' => Carbon::now('America/Lima'),
                'usuario_id' => $comentariosData['usuario_id'],
                'publicacion_id' => $comentariosData['publicacion_id'],
                


            ]);
        }
    }
}
