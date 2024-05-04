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
                'email' => 'huasaca12345',
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
                'imagen' => 'imagen.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 1,
                'tema_id' => 1,
                'usuario_id' => 1,
            ],
            [
                'titulo' => 'Viaje al paraíso',
                'Sub_tema' => 'Viajes',
                'contenido' => 'Descubre los destinos más increíbles',
                'imagen' => 'imagen2.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 2,
                'tema_id' => 2,
                'usuario_id' => 2,
            ],
            [
                'titulo' => 'Recetas del mundo',
                'Sub_tema' => 'Cocina',
                'contenido' => 'Deliciosas recetas de diferentes culturas',
                'imagen' => 'imagen5.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 3,
                'tema_id' => 3,
                'usuario_id' => 3,
            ],
            [
                'titulo' => 'Historias de misterio',
                'Sub_tema' => 'Suspense',
                'contenido' => 'Enigmas y secretos por descubrir',
                'imagen' => 'imagen5.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 1,
                'tema_id' => 4,
                'usuario_id' => 4,
            ],
            [
                'titulo' => 'Tecnología de vanguardia',
                'Sub_tema' => 'Tecnología',
                'contenido' => 'Últimas innovaciones tecnológicas',
                'imagen' => 'imagen5.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 2,
                'tema_id' => 5,
                'usuario_id' => 5,
            ],
            [
                'titulo' => 'Aventuras en la naturaleza',
                'Sub_tema' => 'Aventura',
                'contenido' => 'Explorando paisajes asombrosos',
                'imagen' => 'imagen.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 3,
                'tema_id' => 6,
                'usuario_id' => 1,
            ],
            [
                'titulo' => 'La ciencia detrás del universo',
                'Sub_tema' => 'Ciencia',
                'contenido' => 'Descubriendo los secretos del cosmos',
                'imagen' => 'imagen5.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 1,
                'tema_id' => 7,
                'usuario_id' => 2,
            ],
            [
                'titulo' => 'Arte en movimiento',
                'Sub_tema' => 'Arte',
                'contenido' => 'Explorando la diversidad del arte contemporáneo',
                'imagen' => 'imagen.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 2,
                'tema_id' => 8,
                'usuario_id' => 3,
            ],
            [
                'titulo' => 'Negocios del siglo XXI',
                'Sub_tema' => 'Negocios',
                'contenido' => 'Emprendimientos y estrategias empresariales',
                'imagen' => 'imagen5.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 3,
                'tema_id' => 9,
                'usuario_id' => 4,
            ],
            [
                'titulo' => 'Deportes extremos',
                'Sub_tema' => 'Deportes',
                'contenido' => 'Adrenalina pura y emociones fuertes',
                'imagen' => 'imagen.jpg',
                'fecha_publicacion' => '',
                'categoria_id' => 1,
                'tema_id' => 10,
                'usuario_id' => 5,
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
                'usuario_id' => 1,
                'publicacion_id' => 1,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Excelente artículo',
                'fecha_comentario' => '',
                'usuario_id' => 1,
                'publicacion_id' => 1,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Interesante punto de vista',
                'fecha_comentario' => '',
                'usuario_id' => 2,
                'publicacion_id' => 2,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Gracias por compartir',
                'fecha_comentario' => '',
                'usuario_id' => 1,
                'publicacion_id' => 2,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Muy útil la información',
                'fecha_comentario' => '',
                'usuario_id' => 2,
                'publicacion_id' => 3,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => '¿Puedo compartir este contenido?',
                'fecha_comentario' => '',
                'usuario_id' => 3,
                'publicacion_id' => 3,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Necesito más detalles al respecto',
                'fecha_comentario' => '',
                'usuario_id' => 2,
                'publicacion_id' => 2,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Este tema me inspira',
                'fecha_comentario' => '',
                'usuario_id' => 3,
                'publicacion_id' => 4,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => 'Felicidades por el artículo',
                'fecha_comentario' => '',
                'usuario_id' => 2,
                'publicacion_id' => 5,
                'comentario_padre_id' => '',
            ],
            [
                'contenido' => '¿Hay alguna referencia bibliográfica?',
                'fecha_comentario' => '',
                'usuario_id' => 1,
                'publicacion_id' => '5',
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
