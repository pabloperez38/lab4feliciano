<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Marcas;

class ProductsController extends Controller
{
    public function product_index()
    {
        $datos = Productos::orderBy('id', 'desc')->get();
        $categorias = Categorias::orderBy('id', 'desc')->get();
        $marcas = Marcas::orderBy('id', 'desc')->get();

        return view('productos.index', compact('datos', 'categorias', 'marcas'));
    }

    public function productos_index_post(Request $request){

        $validated = $request->validate([

            'nombre'=>'required',
            'stock'=>'required',
            'id_categoria'=>'required',
            'id_marca'=>'required'
        ],
        [
            'nombre.required'=>'El campo nombre es requerido',
            'stock.required'=>'El stock nombre es requerido',
            'id_categoria.required'=>'El categoría nombre es requerido',
            'id_marca.required'=>'El campo marca es requerido',            
        ]);

        if($request->input('accion') == 1){
            $save = new Productos();
            $save->nombre = $request->nombre;
            $save->stock = $request->stock;
            $save->id_categoria = $request->id_categoria;
            $save->id_marca = $request->id_marca;
            $save->save();

            return redirect()->route('product_index');
        }

        if($request->input('accion') == 2){
            $save = Productos::where(['id' => $request->id])->first();
            $save->nombre = $request->nombre;
            $save->stock = $request->stock;
            $save->id_categoria = $request->id_categoria;
            $save->id_marca = $request->id_marca;
            $save->save();

            return redirect()->route('product_index');
        }
    }

    public function eliminar_producto(Request $request, $id){

        $datos = Productos::where(["id" =>$request->id])->firstOrFail();
        Productos::where(["id"=>$request->id])->delete();

        $request->session()->put('css', 'success');
        $request->session()->put('mensaje','El producto se eliminó correctamente');

        return redirect()->route('product_index');

    }

}
