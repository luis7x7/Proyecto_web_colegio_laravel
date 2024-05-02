<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller

{

    public function index()
    {
        $comentarios = DB::table('comentarios')->get();
        $comentariosCount = $comentarios->count();

        if ($comentariosCount === 0) {
            $data = [
                'message' => 'No hay ninguna publicación',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Listado de comentarios',
            'status' => 200,
            'total_comentarios' => $comentariosCount,
            'comentarios' => $comentarios
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => ['required', 'regex:/^[A-Z]/'],
            'usuario_id' => 'required|integer',
            'publicacion_id' => 'required|integer',
            'comentario_padre_id' => 'nullable|integer|exists:comentarios,id' // Validación para el comentario padre
        ], [
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

        $fecha_comentario = Carbon::now(); // Obtener la fecha y hora actuales

        $comentarioData = [
            'contenido' => $request->contenido,
            'fecha_comentario' => $fecha_comentario, // Establecer la fecha y hora actuales como fecha de comentario
            'usuario_id' => $request->usuario_id,
            'publicacion_id' => $request->publicacion_id,
            'comentario_padre_id' => $request->comentario_padre_id // Guardar el ID del comentario padre
        ];

        // Crear el comentario
        $comentario = Comentarios::create($comentarioData);

        $data = [
            'message' => 'Comentario creado exitosamente',
            'comentario' => $comentario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comentarios = Comentarios::find($id);

        if (!$comentarios) {
            $data = [
                'message' => 'Publicación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'contenido' => 'required',
            'fecha_comentario' => 'required|date',
            'usuario_id' => 'required|integer',
            'publicacion_id' => 'required|integer',

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $comentarios->update($request->all());

        $data = [
            'message' => 'Publicación actualizada exitosamente',
            'publicacion' => $comentarios,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comentarios = Comentarios::find($id);

        if (!$comentarios) {
            $data = [
                'message' => 'Publicación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $comentarios->delete();

        $data = [
            'message' => 'Publicación eliminada exitosamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
