<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
       
        foreach ($usuarios as $usuario) {
            if ($usuario->imagen_usuario) {
                $usuario->imagen_usuario = asset('storage/images/usuarios/' . $usuario->imagen_usuario);
            } else {
                // Si el usuario no tiene imagen, se asigna una imagen por defecto
                $usuario->imagen_usuario = asset('storage/default_user_image.jpg');
            }
        }

        $data = [
            'message' => "usuarios encontrados",
            'data' => $usuarios,
            'status' => 200,
        ];
        return response()->json($data, 200);
    }


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
            'nombre' => 'required|max:50|min:5:',
            'email' => 'required|max:50|',
            'password' => 'required|max:50,,',
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

        // Guardar imagen si se proporciona
        if ($request->hasFile('imagen_usuario')) {
            $imagen = $request->file('imagen_usuario')->store('public/images');
            $imagenUrl = basename($imagen);
        } else {
            $imagenUrl = 'default_user_image.jpg';
        }

        $usuarios->nombre = $request->nombre;
        $usuarios->email = $request->email;
        $usuarios->password = $request->password;
        $usuarios->rol_id = $request->rol_id;
        $usuarios->imagen_usuario = $imagenUrl;
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

    //login  



}
