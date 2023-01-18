@extends('layout.template')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">

                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <h3>INICIAR SESIÓN</h3>
                    </div>
                </div>

                <form method="post" action="{{route('login.perform')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Usuario: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="email" value="{{ old('password') }}">
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña: </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="contraseña" value="{{ old('password') }}" >
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row text-center">
                        <div class="col-sm-10">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-shared"></i>
                                Iniciar Sesión
                            </button>
                        </div>
                    </div>

                </form>


            </div>

        </div>

    </div>


@endsection
