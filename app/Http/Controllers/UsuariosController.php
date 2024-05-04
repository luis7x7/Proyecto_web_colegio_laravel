<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function show($id)
    {
        $Usuario = Usuarios::find($id);



        if (!$Usuario) {
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $Usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    public function show_user_email($email)
    {
        $Usuario = Usuarios::where('email', $email)->get();

        if (!$Usuario) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $resultado = DB::table('usuarios')->select(

            'usuarios.id as id',
            'usuarios.nombre as nombre',
            'usuarios.email as email',
            'usuarios.imagen_usuario as imagen_usuario',
            'roles.nombre as nombre_rol',
        )->join('roles', 'usuarios.rol_id', '=', 'roles.id')->where('usuarios.email', $email)
            ->get();



        foreach ($resultado as $img_user) {

            if ($img_user->imagen_usuario) {
                $img_user->imagen_usuario = asset('storage/images/usuarios/' . $img_user->imagen_usuario);
            } else {
                $img_user->imagen_usuario = asset('storage/default_user_image.jpg');
            }
        }



        $data_user = [
            'data_user' => $resultado->toArray(),
            'status' => 200
        ];
        return response()->json($data_user, 200);
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
            /*'nombre' => 'required|max:50|min:5:',
            'email' => 'required|max:50|',
            'password' => 'required|max:50,,',
            'rol_id' => 'required|integer',
            'imagen_usuario' => 'required|max:255', // Assuming max length for image path*/
            'nombre' => ['required', 'regex:/^[A-Z][a-zA-Z0-9]{1,19}$/'],
            'email' => ['required', 'regex:/^(?=.*[a-zA-Z0-9])((?=.*[a-zA-Z])(?=.*\d)|(?=.*[a-zA-Z])(?=.*[@\.])|(?=.*\d)(?=.*[@\.]))[a-zA-Z0-9@\.]{1,50}$/', 'max:50'],
            'password' => ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{1,10}$/', 'max:10'],
            'imagen_usuario' => 'required|max:512|mimes:jpeg,png',
        ], [

            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.regex' => 'El nombre debe comenzar con mayúscula, contener solo letras y números, y tener un máximo de 20 caracteres.',

            'email.required' => 'El campo email es obligatorio.',
            'email.regex' => 'El formato del email no es válido. Por favor, introduce un correo electrónico de Gmail o Hotmail.',
            'email.max' => 'El correo electrónico no debe tener más de :max caracteres.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.regex' => 'La contraseña debe tener al menos una letra, un número, un carácter especial y un máximo de 10 caracteres.',
            'password.max' => 'La contraseña no debe tener más de :max caracteres.',

            'imagen_usuario.required' => 'El campo imagen es obligatorio.',
            'imagen_usuario.max' => 'La URL de la imagen no debe tener más de 50:max caracteres.',
            'imagen_usuario.mimes' => 'La imagen de usuario debe ser en formato JPG o PNG.',

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
