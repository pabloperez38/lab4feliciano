@extends('../layouts.login')

@section('title', "Login")

@section('content')

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">

            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">                

                <div class="d-table-cell align-middle">

                    @if(Session::has('mensaje'))

                <div class="alert alert-{{Session::get('css')}} alert-dismissible fade show" role="alert">

                    {{Session::get('mensaje')}}                   
                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                  {{Session::forget('css')}}
                  {{Session::forget('mensaje')}}

                @endif

                    <div class="text-center mt-4">
                        <h1 class="h2">Login</h1>
                        <p class="lead">
                            Desarrollado con Laravel 11
                        </p>

                        @if ($errors->any())

                            <div class="alert alert-danger p-3">
                                <ul>
                                    @foreach ($errors->all() as $error)

                                        <li>{{$error}}</li>

                                    @endforeach
                                </ul>
                            </div>

                        @endif

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">

                                <form method="post" name="form" in="form">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="correo"
                                            id="correo" placeholder="Email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contaseña</label>
                                        <input class="form-control form-control-lg" type="password" name="password"
                                            id="password" placeholder="Contraseña" />

                                    </div>

                                    <div class="text-center mt-3">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection