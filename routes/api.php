<?php

use App\Http\Controllers\CategoriasApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request)
{
    return $request->user();
})->middleware('auth:sanctum');

//Ruta de la API

Route::resource('categorias', CategoriasApiController::class);