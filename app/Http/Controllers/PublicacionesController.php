<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $resultados = DB::table('publicaciones')
            ->select(
                'publicaciones.id as id',
                'publicaciones.titulo as titulo',
                'publicaciones.Sub_tema as sub_tema',
                'publicaciones.contenido as contenido',
                'publicaciones.imagen as imagen_publicacion',
                'publicaciones.fecha_publicacion as fecha_publicacion',
                'categorias.nombre as nombre_categoria',
                'temas.nombre as nombre_tema',
                'usuarios.nombre as nombre_usuario',
                'usuarios.email as email_usuario',
                'usuarios.imagen_usuario as imagen_usuario',
                'roles.nombre as nombre_rol'
            )
            ->join('usuarios', 'publicaciones.usuario_id', '=', 'usuarios.id')
            ->join('temas', 'publicaciones.tema_id', '=', 'temas.id')
            ->join('categorias', 'publicaciones.categoria_id', '=', 'categorias.id')
            ->join('roles', 'usuarios.rol_id', '=', 'roles.id')
            ->get();

        foreach ($resultados as $publicacion) {
            if ($publicacion->imagen_publicacion) {
                $publicacion->imagen_publicacion = asset('storage/images/publicaciones/' . $publicacion->imagen_publicacion);
            } else {

                $publicacion->imagen = asset('storage/default_user_image.jpg');
            }
        }

        foreach ($resultados as $publicacion) {
            if ($publicacion->imagen_usuario) {
                $publicacion->imagen_usuario = asset('storage/images/usuarios/' . $publicacion->imagen_usuario);
            } else {

                $publicacion->imagen = asset('storage/default_user_image.jpg');
            }
        }




        $data = $resultados->toArray();

        return $data;
    }

    public function show($id)
    {
        $Publicaciones = Publicaciones::find($id);

        if (!$Publicaciones) {
            $data = [
                'message' => 'Publicaciones no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }













        $resultados = DB::table('publicaciones')
            ->select(
                'publicaciones.id as id',
                'publicaciones.titulo as titulo',
                'publicaciones.Sub_tema as sub_tema',
                'publicaciones.contenido as contenido',
                'publicaciones.imagen as imagen_publicacion',
                'publicaciones.fecha_publicacion as fecha_publicacion',
                'categorias.nombre as nombre_categoria',
                'temas.nombre as nombre_tema',
                'usuarios.nombre as nombre_usuario',
                'usuarios.email as email_usuario',
                'usuarios.imagen_usuario as imagen_usuario',
                'roles.nombre as nombre_rol',

            )
            ->join('usuarios', 'publicaciones.usuario_id', '=', 'usuarios.id')
            ->join('temas', 'publicaciones.tema_id', '=', 'temas.id')
            ->join('categorias', 'publicaciones.categoria_id', '=', 'categorias.id')
            ->join('roles', 'usuarios.rol_id', '=', 'roles.id')

            ->where('publicaciones.id', $id)
            ->get();

        foreach ($resultados as $publicacion) {
            if ($publicacion->imagen_publicacion) {
                $publicacion->imagen_publicacion = asset('storage/images/publicaciones/' . $publicacion->imagen_publicacion);
            } else {
                $publicacion->imagen_publicacion = asset('storage/default_publicacion_image.jpg');
            }

            if ($publicacion->imagen_usuario) {
                $publicacion->imagen_usuario = asset('storage/images/usuarios/' . $publicacion->imagen_usuario);
            } else {
                $publicacion->imagen_usuario = asset('storage/default_user_image.jpg');
            }
        }

        $comentariosCount = DB::table('comentarios')
            ->select('publicacion_id', DB::raw('COUNT(*) as total_comentarios'))
            ->where('publicacion_id', $id)
            ->groupBy('publicacion_id')
            ->first();

        $totalComentarios = $comentariosCount ? $comentariosCount->total_comentarios : 0;



        $data = [
            "data" => $resultados->toArray(),
            "total_comentario" => $totalComentarios

        ];

        return $data;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'Sub_tema' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'required',
            'categoria_id' => 'required|integer',
            'tema_id' => 'required|integer',
            'usuario_id' => 'required|integer',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no debe tener más de :max caracteres.',
            'Sub_tema.required' => 'El campo Sub_tema es obligatorio.',
            'Sub_tema.max' => 'El Sub_tema no debe tener más de :max caracteres.',
            'contenido.required' => 'El campo contenido es obligatorio.',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('public/images/publicaciones');
            $imagenUrl = basename($imagen);
        } else {
            $imagenUrl = 'default_user_image.jpg';
        }

        $fecha_publicacion = Carbon::now(); // Obtiene la fecha actual

        $publicaciones = Publicaciones::create([
            'titulo' => $request->titulo,
            'Sub_tema' => $request->Sub_tema,
            'contenido' => $request->contenido,
            'imagen' => $imagenUrl,
            'fecha_publicacion' => $fecha_publicacion, // Establece la fecha actual como fecha de publicación
            'categoria_id' => $request->categoria_id,
            'tema_id' => $request->tema_id,
            'usuario_id' => $request->usuario_id,
        ]);

        $data = [
            'message' => 'Publicación creada exitosamente',
            'publicacion' => $publicaciones,
            'status' => 201
        ];
        return response()->json($data, 201);
    }


    public function update(Request $request, $id)
    {
        $publicaciones = Publicaciones::find($id);

        if (!$publicaciones) {
            $data = [
                'message' => 'Publicación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'Sub_tema' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'required|max:255',
            'fecha_publicacion' => 'required|date',
            'categoria_id' => 'required|integer',
            'tema_id' => 'required|integer',
            'usuario_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $publicaciones->update($request->all());

        $data = [
            'message' => 'Publicación actualizada exitosamente',
            'publicacion' => $publicaciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publicaciones = Publicaciones::find($id);

        if (!$publicaciones) {
            $data = [
                'message' => 'Publicación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $publicaciones->delete();

        $data = [
            'message' => 'Publicación eliminada exitosamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
