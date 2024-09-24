@extends('../layouts.app')

@section('title', "Marcas")

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h1 mb-3">Marcas</h1>

        <div class="row">

            <div class="col-12 col-lg-12">

                @if(Session::has('mensaje'))

                <div class="alert alert-{{Session::get('css')}} alert-dismissible fade show" role="alert">

                    {{Session::get('mensaje')}}                   
                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                  {{Session::forget('css')}}
                  {{Session::forget('mensaje')}}

                @endif

                @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">
                    
                            @foreach ($errors->all() as $error)

                                {{$error}}

                            @endforeach
                    
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($datos as $dato)

                                    <tr>
                                        <td>{{$dato->id}}</td>
                                        <td>{{$dato->nombre}}</td>
                                        <td>
                                            <button class="btn btn-warning"  onclick="abrir_modal('ventana_modal', 'Editar {{$dato->nombre}}', 2, ['nombre'], {{$dato}})" ><i class="fas fa-edit"></i></button>

                                            <button type="button" class="btn btn-danger" onclick="confirmarSweet('¿Desea eliminar la marca?','{{route('eliminar_marca', ['id'=>$dato->id])}}')"><i class="fas fa-trash"></i></button>
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
        <form action="{{route('marcas_index_post')}}" name="form" method="post">
            {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ventana_modal_titulo"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <div class="form-group">
            <label for="nombre">Nombre marca</label>
     
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la marca">
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