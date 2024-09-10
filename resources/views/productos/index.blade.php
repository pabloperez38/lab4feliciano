@extends('../layouts.app')

@section('title', "Productos")

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h1 mb-3">Productos</h1>

        <div class="row">

            <div class="col-12 col-lg-12">

                @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">

                        <ul>
                    
                            @foreach ($errors->all() as $error)

                                <li>{{$error}}</li>

                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif

                <div class="card">

                    <div class="card-header">
                        <button class="btn btn-primary float-end" 
                        onclick="abrir_modal('ventana_modal', 'Agregar', 1, [], [])"
                        ><i class="fas fa-plus"></i> Agregar</button>
                    </div>  

                    <div class="card-body">

                        <div class="table-reponsive">

                            <table class="table table-bordered table-striped table-over">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Categoría</th>
                                        <th>Marca</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($datos as $dato)

                                    <tr>
                                        <td>{{$dato->id}}</td>
                                        <td>{{$dato->nombre}}</td>
                                        <td>{{$dato->stock}}</td>
                                        <td>{{$dato->categorias->nombre}}</td>
                                        <td>{{$dato->marcas->nombre}}</td>
                                        <td>
                                            <button class="btn btn-warning"  onclick="abrir_modal('ventana_modal', 'Editar {{$dato->nombre}}', 2, ['nombre', 'stock', 'id_categoria', 'id_marca'], {{$dato}})" ><i class="fas fa-edit"></i></button>

                                            <a class="btn btn-danger" href=""><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                        
                                    @endforeach

                                </tbody>

                            </table>
                        </div>    

                    </div>

                </div>

            </div> 

        </div> 

    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="ventana_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('productos_index_post')}}" name="form" method="post">
            {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ventana_modal_titulo"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <div class="form-group">
            <label for="nombre">Nombre producto</label>
     
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del producto">
         </div>
         <div class="form-group mt-3">
            <label for="stock">Stock producto</label>
     
            <input type="text" name="stock" id="stock" class="form-control" placeholder="Stock">
         </div>
         <div class="form-group mt-3">
            <label for="stock">Categoría</label>

            <select name="id_categoria" id="id_categoria" class="form-control">
                
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)

                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>

                @endforeach

            </select>     
           
         </div>

         <div class="form-group mt-3">
            <label for="stock">Marca</label>

            <select name="id_marca" id="id_marca" class="form-control">
                
                <option value="">Seleccione una marca</option>
                @foreach($marcas as $marca)

                <option value="{{$marca->id}}">{{$marca->nombre}}</option>

                @endforeach

            </select>     
           
         </div>
         
        </div>
        <div class="modal-footer">

            <input type="hidden" name="accion" id="accion" value="1">
            <input type="hidden" name="id" id="id" value="0">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection