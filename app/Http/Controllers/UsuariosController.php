<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::all();

        if ($usuarios->isEmpty()) {
            $data = [
                'message' => 'No hay ningún usuarios',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $usuarios,
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
            'nombre' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:50',
            'rol_id' => 'required|integer',
            'imagen_usuario' => 'required|max:255', // Assuming max length for image path
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación del usuario',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuarios = Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'rol_id' => $request->rol_id,
            'imagen_usuario' => $request->imagen_usuario,
            
        ]);

        if (!$usuarios) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $usuarios,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuarios = Usuarios::find($id);

        if (!$usuarios) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:50',
            'rol_id' => 'required|integer',
            'imagen_usuario' => 'required|max:255', // Assuming max length for image path
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuarios->nombre = $request->nombre;
        $usuarios->email = $request->email;
        $usuarios->password = $request->password;
        $usuarios->rol_id = $request->rol_id;
        $usuarios->imagen_usuario = $request->imagen_usuario;
        $usuarios->save();

        $data = [
            'message' => 'Usuario actualizado',
            'usuario' => $usuarios,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuarios = Usuarios::find($id);

        if (!$usuarios) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuarios->delete();
        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
