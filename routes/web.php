<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* 
Route::get('/', function ()
{
    return view('welcome');
}); */

//Ruta principal
Route::get('/', [HomeController::class, 'home_index'])->name("home_index");

//Ruta usuarios
Route::get('/usuarios', [UserController::class, 'user_index'])->name('user_index');
//Ruta productos
Route::get('/productos', [ProductsController::class, 'product_index'])->name('product_index');

Route::get('/login', [LoginController::class, 'login_index'])->name('login_index');

Route::post('/login', [LoginController::class, 'login_index_post'])->name('login_index_post');