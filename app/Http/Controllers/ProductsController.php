<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function product_index()
    {
        return view('productos.index');
    }
}
