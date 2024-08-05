<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;

Route::get('/', HomeController::class)->name("home")->middleware("auth");

//Ruta para editar el perfil
Route::get("/editar-perfil", [PerfilController::class, "index"])->name("perfil.index")->middleware("auth");
Route::post("/editar-perfil", [PerfilController::class, "store"])->name("perfil.store")->middleware("auth");

//URL de registro
Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register', [RegisterController::class, 'store']);

//Login
Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"]);

//Logout
Route::post("/logout", [LogoutController::class, "store"])->name("logout");

//URL de inicio de sesión
Route::get("/{user:username}", [PostController::class, "index"])->name("post.index");
Route::get("/post/create", [PostController::class, "create"])->name("post.create")->middleware("auth");
Route::post("/post", [PostController::class, "store"])->name("post.store")->middleware("auth");
Route::get("/{user:username}/post/{post}", [PostController::class, "show"])->name("post.show");
Route::delete("/post/{post}", [PostController::class, "destroy"])->name("post.destroy")->middleware("auth");

//Añadir comentarios
Route::post("/{user:username}/post/{post}", [ComentarioController::class, "store"])->name("comentarios.store");

//Like a las fotos
Route::post("/post/{post}/likes", [LikeController::class, "store"])->name("post.likes.store")->middleware("auth");
//Quitar el Like a las fotos
Route::delete("/post/{post}/likes", [LikeController::class, "destroy"])->name("post.likes.destroy")->middleware("auth");

Route::post("/imagenes", [ImagenController::class, "store"])->name("imagenes.store")->middleware("auth");

//Siguiendo usuarios
Route::post("/{user:username}/follow", [FollowerController::class, "store"])->name("users.follow")->middleware("auth");
Route::delete("/{user:username}/unfollow", [FollowerController::class, "destroy"])->name("users.unfollow")->middleware("auth");