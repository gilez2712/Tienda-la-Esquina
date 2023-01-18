@extends('layout.template')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left ">
                    <h2>Editar Usuario</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('Usuario.update',$usuario->id) }}" method="POST" enctype="multipart/form-data" class="form-control">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" name="name"  placeholder="Nombre" value="{{$usuario->name}}">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo: </label>
                    <input type="email" class="form-control" name="email"  placeholder="Correo" value="{{$usuario->email}}">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" class="form-control" name="username"  placeholder="Username" value="{{$usuario->username}}">
                    @error('username')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo: </label>
                    <select class="form-control" name="tipo" >
                        <option value="ADMIN">Admin</option>
                        <option value="USR">Usuario</option>
                    </select>
                    @error('tipo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                <div class="col-md-6">
                    <a  class="btn btn-danger " href="{{ route('Usuario.index') }}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
