<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginRegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:20|string|min:8',
            'rol_id' => 'required|integer',
            'imagen_usuario' => 'max:512', // Assuming max length for image path
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación del usuario',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Guardar imagen si se proporciona
        if ($request->hasFile('imagen_usuario')) {
            $imagen = $request->file('imagen_usuario')->store('public/images/usuarios');
            $imagenUrl = basename($imagen);
        } else {
            $imagenUrl = 'default_user_image.jpg';
        }
        $usuarios = Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'imagen_usuario' => $imagenUrl,

        ]);
        $data['token'] = $usuarios->createToken($request->email)->plainTextToken;
        $data['user'] = $usuarios;

        if (!$usuarios) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $Responce = [
            'message' => "usuario creado exitosamente ",
            'data' => $data,
            'status' => 201
        ];
        return response()->json($Responce, 201);
    }


    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validación Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        // Check email exist
        $user = Usuarios::where('email', $request->email)->first();

        // Check password
        if (password_verify($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Credenciales Invalidas',
            ], 401);
        }

        if (auth()->check()) {
            // El usuario está autenticado
            $password = auth()->user()->password;
        }


        $data['token'] = $user->createToken($request->email)->plainTextToken;
        $data['user'] = $user;

        $response = [
            'status' => 'success',
            'message' => 'Inicio de Secion Activa',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Seccion de Usuario desactivada'
        ], 200);
    }



    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8', // Mínimo 8 caracteres
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación de las credenciales', 'errors' => $validator->errors()], 422);
        }

        $user = Usuarios::where('email', $request->email)->first();

        // Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Verificar si la contraseña anterior coincide
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'La contraseña anterior no coincide'], 422);
        }

        // Cambiar la contraseña
        $user->password = Hash::make($request->new_password);
        $user->save();


        return response()->json(['message' => 'Contraseña cambiada con éxito'], 200);
    }
}
