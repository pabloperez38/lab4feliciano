<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
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
        if ($request->input('accion') == "2") {

            $save = Categorias::where(["id" => $request->id])->first();
            $save->nombre = $request->nombre;
            $save->save();
            return redirect()->route("categorias_index");
            }  

    }

    public function eliminar_categoria(Request $request, $id){

        $datos = Categorias::where(["id" =>$request->id])->firstOrFail();

        $existe = Productos::where(["id_categoria"=>$id])->count();

        if($existe == 0){

            Categorias::where(["id"=>$request->id])->delete();
            $request->session()->put('css', 'success');
            $request->session()->put('mensaje','La categoría se eliminó correctamente');

        }else{

            $request->session()->put('css', 'danger');
            $request->session()->put('mensaje','Error al eliminar la categoría');

        }       

        return redirect()->route('categorias_index');

    }
}
