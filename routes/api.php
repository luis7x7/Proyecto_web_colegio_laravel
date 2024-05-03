<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\RespuestacomentarioController;

//CATEGORIA
Route::get('/categorias', [CategoriasController::class, 'index']);

Route::get('/categorias/{id}', [CategoriasController::class, 'show']);



//TEMA
Route::get('/tema', [TemaController::class, 'index']);

Route::get('/tema/{id}', [TemaController::class, 'show']);



//ROLES
Route::get('/roles', [RolesController::class, 'index']);

Route::get('/roles/{id}', [RolesController::class, 'show']);



//USUARIOS

Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);

Route::get('/usuarios_email/{email}', [UsuariosController::class, 'show_user_email']);




//publicaciones

Route::get('/publicaciones', [PublicacionesController::class, 'index']);

Route::get('/publicaciones/{id}', [PublicacionesController::class, 'show']);

Route::post('/publicaciones', [PublicacionesController::class, 'store']);

Route::put('/publicaciones/{id}', [PublicacionesController::class, 'update']);

Route::delete('/publicaciones/{id}', [PublicacionesController::class, 'destroy']);


// comentario
Route::get('/comentarios', [ComentariosController::class, 'index']);

Route::get('/comentarios/{id}', [ComentariosController::class, 'show']);





//user validacion login


Route::controller(LoginRegisterController::class)->group(function () {
     Route::post('/register', 'register');
     Route::post('/login', 'login');
     Route::post('/changePassword', 'changePassword');
});


// Protected routes of product and logout
Route::middleware('auth:sanctum')->group(function () {
     Route::post(
          '/logout',

          [LoginRegisterController::class, 'logout']

     );




     //roles 

     Route::post('/roles', [RolesController::class, 'store']);

     Route::put('/roles/{id}', [RolesController::class, 'update']);

     Route::delete('/roles/{id}', [RolesController::class, 'destroy']);

     Route::patch('/roles/{id}', [RolesController::class, 'updatepartial']);


     //categorias
     Route::post('/categorias', [CategoriasController::class, 'store']);

     Route::put('/categorias/{id}', [CategoriasController::class, 'update']);

     Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy']);

     Route::patch('/categorias/{id}', [CategoriasController::class, 'updatepartial']);
     //temas

     Route::post('/tema', [TemaController::class, 'store']);

     Route::put('/tema/{id}', [TemaController::class, 'update']);

     Route::delete('/tema/{id}', [TemaController::class, 'destroy']);

     Route::patch('/tema/{id}', [TemaController::class, 'updatepartial']);



     //users
     Route::post('/usuarios', [UsuariosController::class, 'store']);

     Route::put('/usuarios/{id}', [UsuariosController::class, 'update']);

     Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy']);

     Route::patch('/usuarios/{id}', [UsuariosController::class, 'updatepartial']);


     //publicaciones
     

     Route::patch('/publicaciones/{id}', [PublicacionesController::class, 'updatepartial']);



     //comentarios

     Route::post('/comentarios', [ComentariosController::class, 'store']);

     Route::put('/comentarios/{id}', [ComentariosController::class, 'update']);

     Route::delete('/comentarios/{id}', [ComentariosController::class, 'destroy']);

     Route::patch('/comentarios/{id}', [ComentariosController::class, 'updatepartial']);
});
