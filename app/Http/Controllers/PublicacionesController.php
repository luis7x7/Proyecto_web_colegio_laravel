<?php

namespace App\Http\Controllers;

use App\Models\Publicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publicaciones::all();

        if ($publicaciones->isEmpty()) {
            $data = [
                'message' => 'No hay ninguna publicación',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $publicaciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        $publicaciones = Publicaciones::create([
            'titulo' => $request->titulo,
            'Sub_tema' => $request->Sub_tema,
            'contenido' => $request->contenido,
            'imagen' => $request->imagen,
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
