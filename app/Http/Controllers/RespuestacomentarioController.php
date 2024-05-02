<?php

namespace App\Http\Controllers;

use App\Models\respuestacomentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class RespuestacomentarioController extends Controller
{
    


    public function index()
    {
        $respuestacomentario = Respuestacomentario::all();

        if ($respuestacomentario->isEmpty()) {
            $data = [
                'message' => 'No hay ninguna publicación',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $respuestacomentario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => ['required', 'regex:/^[A-Z]/'],
            'fecha_comentario' => 'required|date',
            'usuario_id' => 'required|integer',
            'comentario_id' => 'required|integer',

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


        $respuestacomentario = Respuestacomentario::create([
            'contenido' => $request->contenido,
            'fecha_comentario' => $request->fecha_comentario,
            'usuario_id' => $request->usuario_id,
            'comentario_id' => $request->comentario_id,


        ]);

        $data = [
            'message' => 'Publicación creada exitosamente',
            'publicacion' => $respuestacomentario,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(respuestacomentario $respuestacomentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(respuestacomentario $respuestacomentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $respuestacomentario = Respuestacomentario::find($id);

        if (!$respuestacomentario) {
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
            'comentario_id' => 'required|integer',

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $respuestacomentario->update($request->all());

        $data = [
            'message' => 'Publicación actualizada exitosamente',
            'publicacion' => $respuestacomentario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $respuestacomentario = Respuestacomentario::find($id);

        if (!$respuestacomentario) {
            $data = [
                'message' => 'Publicación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $respuestacomentario->delete();

        $data = [
            'message' => 'Publicación eliminada exitosamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
