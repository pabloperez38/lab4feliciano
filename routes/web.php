<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MarcasController;
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

//Ruta categorias
Route::get('/categorias', [CategoriasController::class, 'categorias_index'])->name('categorias_index')->middleware(Acceso::class);

Route::post('/categorias', [CategoriasController::class, 'categorias_index_post'])->name('categorias_index_post')->middleware(Acceso::class);

Route::get('/categorias/delete/{id}', [CategoriasController::class, 'eliminar_categoria'])->name('eliminar_categoria')->middleware(Acceso::class);

//Ruta marcas
Route::get('/marcas', [MarcasController::class, 'marcas_index'])->name('marcas_index')->middleware(Acceso::class);

Route::post('/marcas', [MarcasController::class, 'marcas_index_post'])->name('marcas_index_post')->middleware(Acceso::class);

Route::get('/marcas/delete/{id}', [MarcasController::class, 'eliminar_marca'])->name('eliminar_marca')->middleware(Acceso::class);

//Ruta productos
Route::get('/productos', [ProductsController::class, 'product_index'])->name('product_index')->middleware(Acceso::class);

Route::post('/productos', [ProductsController::class, 'productos_index_post'])->name('productos_index_post')->middleware(Acceso::class);

Route::get('/productos/delete/{id}', [ProductsController::class, 'eliminar_producto'])->name('eliminar_producto')->middleware(Acceso::class);

//Página login
Route::get('/login', [LoginController::class, 'login_index'])->name('login_index');

//Ingreso de usuario
Route::post('/login', [LoginController::class, 'login_index_post'])->name('login_index_post');

//Salir
Route::get('/salir', [LoginController::class, 'login_salir'])->name('login_salir');