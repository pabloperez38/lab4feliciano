<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function categorias_index()
    {
        $datos = Categorias::orderBy("id", "desc")->get();
        return view("categorias.index", compact("datos"));
    }

    public function categorias_index_post(Request $request)
    {

        $validar = $request->validate([
         'nombre' => "required"
        ],
        [
            'nombre.required' => "EL campo nombre no puede estar vacío"
        ]);

        if ($request->input('accion') == "1")
        {
            $save         = new Categorias;
            $save->nombre = $request->nombre;
            $save->save();

            return redirect()->route("categorias_index");
        }

    }
}
