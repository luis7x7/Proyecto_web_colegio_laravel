<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::all();

        if ($roles->isEmpty()) {
            $data = [
                'message' => 'No hay ningún rol',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $roles,
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
                'message' => 'Error en la validación del nombre',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $roles = Roles::create([
            'nombre' => $request->nombre,
        ]);

        if (!$roles) {
            $data = [
                'message' => 'Error al crear el rol',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $roles,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $roles = Roles::find($id);

        if (!$roles) {
            $data = [
                'message' => 'Rol no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $roles,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $roles = Roles::find($id);

        if (!$roles) {
            $data = [
                'message' => 'Rol no encontrado',
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

        $roles->nombre = $request->nombre;
        $roles->save();

        $data = [
            'message' => 'Rol actualizado',
            'roles' => $roles,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $roles = Roles::find($id);

        if (!$roles) {
            $data = [
                'message' => 'Rol no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $roles->delete();
        $data = [
            'message' => 'Rol eliminado',
            'status' => 404
        ];
        return response()->json($data, 200);
    }

    /////
    public function updatepartial(Request $request, $id)
    {


        $roles = Roles::find($id);

        if (!$roles) {
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
            $roles->nombre = $request->nombre;
        }

        $roles->save();

        $data = [
            'message' => "rol actualizado",
            'roles' => $roles,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
