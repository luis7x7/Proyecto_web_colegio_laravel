<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categorias::all();

        if ($categorias->isEmpty()) {
            $data = [
                'message' => 'No hay ninguna categoria',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $categorias,
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
                'message' => 'Error en la validación de la categoria',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categorias = Categorias::create([
            'nombre' => $request->nombre,
        ]);

        if (!$categorias) {
            $data = [
                'message' => 'Error al crear de la categoria',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $categorias,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorias = Categorias::find($id);

        if (!$categorias) {
            $data = [
                'message' => 'categoria no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $categorias,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorias $categorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categorias = Categorias::find($id);

        if (!$categorias) {
            $data = [
                'message' => 'categoria no encontrado',
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

        $categorias->nombre = $request->nombre;
        $categorias->save();

        $data = [
            'message' => 'categorias actualizado',
            'categorias' => $categorias,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorias = Categorias::find($id);

        if (!$categorias) {
            $data = [
                'message' => 'categorias no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $categorias->delete();
        $data = [
            'message' => 'categorias eliminado',
            'status' => 404
        ];
        return response()->json($data, 200);
    }

    /////
    public function updatepartial(Request $request, $id)
    {


        $categorias = Categorias::find($id);

        if (!$categorias) {
            $data = [
                'message' => ' categorias no encontrado',
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
            $categorias->nombre = $request->nombre;
        }

        $categorias->save();

        $data = [
            'message' => "categorias actualizado",
            'categorias' => $categorias,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
