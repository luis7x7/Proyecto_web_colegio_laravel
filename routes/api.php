<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\ComentariosController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CATEGORIA
Route::get('/categorias', [CategoriasController::class, 'index']);

Route::get('/categorias/{id}', [CategoriasController::class, 'show']);

Route::post('/categorias', [CategoriasController::class, 'store']);

Route::put('/categorias/{id}', [CategoriasController::class, 'update']);

Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy']);

Route::patch('/categorias/{id}', [CategoriasController::class, 'updatepartial']);

//TEMA
Route::get('/tema', [TemaController::class, 'index']);

Route::get('/tema/{id}', [TemaController::class, 'show']);

Route::post('/tema', [TemaController::class, 'store']);

Route::put('/tema/{id}', [TemaController::class, 'update']);

Route::delete('/tema/{id}', [TemaController::class, 'destroy']);

Route::patch('/tema/{id}', [TemaController::class, 'updatepartial']);


//ROLES
Route::get('/roles', [RolesController::class, 'index']);

Route::get('/roles/{id}', [RolesController::class, 'show']);

Route::post('/roles', [RolesController::class, 'store']);

Route::put('/roles/{id}', [RolesController::class, 'update']);

Route::delete('/roles/{id}', [RolesController::class, 'destroy']);

Route::patch('/roles/{id}', [RolesController::class, 'updatepartial']);


//USUARIOS

Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::get('/usuarios/{id}', [UsuariosController::class, 'show']);

Route::post('/usuarios', [UsuariosController::class, 'store']);

Route::put('/usuarios/{id}', [UsuariosController::class, 'update']);

Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy']);

Route::patch('/usuarios/{id}', [UsuariosController::class, 'updatepartial']);


//publicaciones

Route::get('/publicaciones', [PublicacionesController::class, 'index']);

Route::get('/publicaciones/{id}', [PublicacionesController::class, 'show']);

Route::post('/publicaciones', [PublicacionesController::class, 'store']);

Route::put('/publicaciones/{id}', [PublicacionesController::class, 'update']);

Route::delete('/publicaciones/{id}', [PublicacionesController::class, 'destroy']);

Route::patch('/publicaciones/{id}', [PublicacionesController::class, 'updatepartial']);

//respuest comentario

Route::get('/respuestacomentario', [ComentariosController::class, 'index']);

Route::get('/respuestacomentario/{id}', [ComentariosController::class, 'show']);

Route::post('/respuestacomentario', [ComentariosController::class, 'store']);

Route::put('/respuestacomentario/{id}', [ComentariosController::class, 'update']);

Route::delete('/respuestacomentario/{id}', [ComentariosController::class, 'destroy']);

Route::patch('/respuestacomentario/{id}', [ComentariosController::class, 'updatepartial']);
