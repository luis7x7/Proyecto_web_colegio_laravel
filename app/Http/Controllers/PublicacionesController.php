<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
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
            'usuarios.imagen_usuario as imagen_usuario',
            'usuarios.nombre as nombre_usuario',
            'usuarios.email as email_usuario',
            'publicaciones.Sub_tema as sub_tema',
            'publicaciones.fecha_publicacion as fecha_publicacion',
            'publicaciones.imagen as imagen_publicacion',
            'temas.nombre as nombre_tema',
            'categorias.nombre as nombre_categoria',
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

        // $publicaciones = Publicaciones::all();

        // if ($publicaciones->isEmpty()) {
        //     $data = [
        //         'message' => 'No hay ninguna publicación',
        //         'status' => 404
        //     ];
        //     return response()->json($data, 404);
        //}
       

        // $data = [
        //     'message' => $publicaciones,
        //     'status' => 200
        // ];
        // return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
<<<<<<< HEAD
            'titulo' => ['required', 'max:255', 'regex:/^[A-Z].*/'],
            'Sub_tema' => ['required', 'max:255', 'regex:/^[A-Z]/'],
            'contenido' => ['required', 'regex:/^[A-Z]/'],
            'imagen' => 'required|max:255',
=======
            'titulo' => 'required|max:255',
            'Sub_tema' => 'required|max:255',
            'contenido' => 'required',
            'imagen' => 'required',
>>>>>>> 2533ab8966f6eefbc66bca3e203fcae450d4df28
            'fecha_publicacion' => 'required|date',
            'categoria_id' => 'required|integer',
            'tema_id' => 'required|integer',
            'usuario_id' => 'required|integer',

        ], [

            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El título no debe tener más de :max caracteres.',
            'titulo.regex' => 'El título debe comenzar con una letra mayúscula.',

            'Sub_tema.required' => 'El campo Sub_tema es obligatorio.',
            'Sub_tema.max' => 'El Sub_tema no debe tener más de :max caracteres.',
            'Sub_tema.regex' => 'El Sub_tema debe comenzar con una letra mayúscula.',

            'contenido.required' => 'El campo contenido es obligatorio.',
            'contenido.regex' => 'El campo contenido debe comenzar con una letra mayúscula.',






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

        $publicaciones = Publicaciones::create([
            'titulo' => $request->titulo,
            'Sub_tema' => $request->Sub_tema,
            'contenido' => $request->contenido,
            'imagen' => $imagenUrl,
            'fecha_publicacion' => $request->fecha_publicacion,
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

    /**
     * Update the specified resource in storage.
     */
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
