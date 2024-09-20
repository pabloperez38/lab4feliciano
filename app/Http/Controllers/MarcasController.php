<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Models\Productos;
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

    public function eliminar_marca(Request $request, $id){

        $datos = Marcas::where(["id" =>$request->id])->firstOrFail();
        
        $existe = Productos::where(["id_marca"=>$id])->count();

        if($existe == 0){

            Marcas::where(["id"=>$request->id])->delete();
            $request->session()->put('css', 'success');
            $request->session()->put('mensaje','La marca se eliminó correctamente');

        }else{

            $request->session()->put('css', 'danger');
            $request->session()->put('mensaje','Error al eliminar la marca');

        }        

        return redirect()->route('marcas_index');

    }
}
