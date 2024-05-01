<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tema = Tema::all();

        if ($tema->isEmpty()) {
            $data = [
                'message' => 'No hay ningún tema',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $tema,
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
            'nombre' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación del tema',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tema = Tema::create([
            'nombre' => $request->nombre,
        ]);

        if (!$tema) {
            $data = [
                'message' => 'Error al crear el tema',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $tema,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tema = Tema::find($id);

        if (!$tema) {
            $data = [
                'message' => 'tema no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $tema,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tema $tema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tema = Tema::find($id);

        if (!$tema) {
            $data = [
                'message' => 'tema no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $tema->nombre = $request->nombre;
        $tema->save();

        $data = [
            'message' => 'Rol actualizado',
            'tema' => $tema,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tema = Tema::find($id);

        if (!$tema) {
            $data = [
                'message' => 'tama no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $tema->delete();
        $data = [
            'message' => 'tama eliminado',
            'status' => 404
        ];
        return response()->json($data, 200);
    }

    /////
    public function updatepartial(Request $request, $id)
    {


        $tema = Tema::find($id);

        if (!$tema) {
            $data = [
                'message' => ' rol no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [

            'nombre' => 'max:50',


        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'error en la validacion de los datos ',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        if ($request->has('nombre')) {
            $tema->nombre = $request->nombre;
        }

        $tema->save();

        $data = [
            'message' => "tema actualizado",
            'tema' => $tema,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
