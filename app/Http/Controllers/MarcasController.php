<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function marcas_index()
    {
        $datos = Marcas::orderBy("id", "desc")->get();
        return view("marcas.index", compact("datos"));

    }

    public function marcas_index_post(Request $request){

        $validated = $request -> validate([

            'nombre' => "required",

        ],
        [
            'nombre.required' => "El campo nombre no puede estar vacío"
        ]);

        if ($request->input('accion') == "1") {
            $save = new Marcas;
            $save->nombre = $request->nombre;
            $save->save();
            return redirect()->route("marcas_index");
            }
        if ($request->input('accion') == "2") {

            $save = Marcas::where(["id" => $request->id])->first();
            $save->nombre = $request->nombre;
            $save->save();
            return redirect()->route("marcas_index");
            }          
     
    }
}
