@extends('layout.template')

@section('content')
    @auth()
        <h3>Dar de alta un Proveedor</h3>

        <form method="POST" action="{{route('Proveedor.store')}}">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="" name="nombre" >
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="descripcion">
            </div>


            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-danger" href="{{route('Proveedor.index')}}">Cancelar</a>
            </div>

        </form>


    @endauth
@endsection
