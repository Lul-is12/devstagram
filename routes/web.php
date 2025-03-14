<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Livewire\LikePost;

//Route::get('/', function () {
 //   return view('principal');
//})->name('principal');

//Route::get('/',[HomeController::class,'index'])->name('home'); 
Route::get('/',HomeController::class)->name('home')->middleware('auth'); 

Route::get('/crear-cuenta', [RegisterController::class,'index'])->name('registrar');
Route::post('/crear-cuenta', [RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index')->middleware('auth');
Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store')->middleware('auth');
                                                              
Route::get('/{user:username}',[PostController::class,'index'])->name('post.index'); //->middleware('auth')
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create')->middleware('auth');
Route::post('/post',[PostController::class,'store'])->name('post.store')->middleware('auth');
Route::get('/{user:username}/post/{post}',[PostController::class,'show'])->name('posts.show'); //->middleware('auth')
Route::delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/{user:username}/post/{post}',[ComentarioController::class,'store'])->name('comentarios.store')->middleware('auth'); //

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');


//Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
//Like a las fotos
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//siguiendo usuarios
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name
('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name
('users.unfollow');



//Livewire
Route::get('/like-post', LikePost::class);


//Model View Controller (MVC)
//Modelo: Encargado de la interaccion de la base de datos, obtener datos, actualizarlos, etc.
//Vista: Se encarga de todo lo que se ve en pantallas.
//Controlador: Comunica modelo y vista. Encargado de llamar un modelo en especifico.