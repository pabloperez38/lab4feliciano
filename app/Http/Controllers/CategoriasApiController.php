<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Http\Request;

class CategoriasApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categorias = Categorias::orderBy('id', 'desc')->get();
       return response()->json($categorias, 200);
    }

    /**
     * Store a newly created resource in storage.
     * Guardar datos
     */
    public function store(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'), true);

        //print_r($json);

        if(!is_array($json)){

            $array = array(
                "response" =>array(
                    "estado" => "Bad request",
                    "mensaje" => "Error al procesar la información"
                )
            );
            return response()->json($array, 400);
        }
        $save = new Categorias;
        $save ->nombre = $request->nombre;
        $save -> save();

        $array = array(
            "response" =>array(
                "estado" => "Ok",
                "mensaje" => "Registro creado correctamente"
            )
        );
        return response()->json($array, 201);
       
    }

    /**
     * Display the specified resource.
     * Listar por ID
     */
    public function show(string $id)
    {
       $categoria = Categorias::where(['id'=>$id])->firstOrFail();
       return response()->json($categoria, 200);
    }

    /**
     * Update the specified resource in storage.
     * Actualizar datos
     */
    public function update(Request $request, string $id)
    {
        $json = json_decode(file_get_contents('php://input'), true);

        //print_r($json);

        if(!is_array($json)){

            $array = array(
                "response" =>array(
                    "estado" => "Bad request",
                    "mensaje" => "Error al procesar la información"
                )
            );
            return response()->json($array, 400);
        }
        $save = Categorias::where(["id"=>$id])->firstOrFail();
        $save ->nombre = $request->nombre;
        $save -> save();

        $array = array(
            "response" =>array(
                "estado" => "Ok",
                "mensaje" => "Registro actualizado correctamente"
            )
        );
        return response()->json($array, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categorias::where(["id" => $id])->firstOrFail();
        
        $existe = Productos::where(["id_categoria"=>$id])->count();

        if($existe == 0){

            Categorias::where(["id"=>$id])->delete();
            $array = array(
                "response" =>array(
                    "estado" => "Ok",
                    "mensaje" => "Registro eliminado correctamente"
                )
            );
            return response()->json($array, 201);

        }else{

            $array = array(
                "response" =>array(
                    "estado" => "Bad request",
                    "mensaje" => "Error al eliminar la información"
                )
            );
            return response()->json($array, 400);

        } 
    }
}
