<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Acceso;
use Illuminate\Support\Facades\Route;

/* 
Route::get('/', function ()
{
    return view('welcome');
}); */

//Ruta principal
Route::get('/', [HomeController::class, 'home_index'])->name("home_index")->middleware(Acceso::class);

//Ruta usuarios
Route::get('/usuarios', [UserController::class, 'user_index'])->name('user_index')->middleware(Acceso::class);

//Ruta productos
Route::get('/productos', [ProductsController::class, 'product_index'])->name('product_index')->middleware(Acceso::class);

//Página login
Route::get('/login', [LoginController::class, 'login_index'])->name('login_index');

//Ingreso de usuario
Route::post('/login', [LoginController::class, 'login_index_post'])->name('login_index_post');

//Salir
Route::get('/salir', [LoginController::class, 'login_salir'])->name('login_salir');