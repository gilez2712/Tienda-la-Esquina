@extends('layout.template')

@section('content')
    @auth()
        <div class="container m-4">
            <h2>Sistema de Ventas</h2>
        </div>
    @endauth
@endsection
