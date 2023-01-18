@extends('layout.template')

@section('content')
    @auth()
        <h3>Dar de alta un Usuario</h3>

        <form method="POST" action="{{route('Usuario.store')}}">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="" name="name" >
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="username">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="">
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo: </label>
                <select class="form-control" name="tipo" >
                    <option value="ADMIN">Admin</option>
                    <option value="USR">Usuario</option>
                </select>

            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-danger" href="{{route('Usuario.index')}}">Cancelar</a>
            </div>

        </form>


    @endauth
@endsection
