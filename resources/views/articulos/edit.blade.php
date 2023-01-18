@extends('layout.template')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left ">
                    <h2>Editar Articulo</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('Articulo.update',$articulo->id) }}" method="POST" enctype="multipart/form-data" class="form-control">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="" name="nombre" value="{{$articulo->nombre}}">
                    @error('nombre')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="descripcion" value="{{$articulo->descripcion}}">
                    @error('descripcion')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="cantidad" value="{{$articulo->cantidad}}">
                    @error('cantidad')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">precio</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="precio" value="{{$articulo->precio}}">
                    @error('precio')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">stock</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="stock" value="{{$articulo->stock}}">
                    @error('stock')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">fecha_caducidad</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="" name="fecha_caducidad" value="{{$articulo->fecha_caducidad}}">
                    @error('fecha_caducidad')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                    <select name="departamento" id="departamento" class="form-control">
                        <option value="LACTEOS">'LACTEOS'</option>,
                        <option value="BEBIDAS">'BEBIDAS'</option>,
                        <option value="ENLATADOS">'ENLATADOS'</option>,
                        <option value="BLANCOS">'BLANCOS'</option>,
                        <option value="FERRETERIA">'FERRETERIA'</option>,
                        <option value="JARDINERIA">'JARDINERIA'</option>,
                        <option value="PINTURA">'PINTURA'</option>,
                        <option value="PAPELERIA">'PAPELERIA'</option>,
                        <option value="GENERAL">'GENERAL'</option>
                    </select>
                    @error('departamento')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">id_prov</label>
                    <select name="id_prov" id="id_prov"class="form-control"></select>
                    @error('id_prov')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 text-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                <div class="col-md-6">
                    <a  class="btn btn-danger " href="{{ route('Articulo.index') }}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>

        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"GET",
                url: "{{ route('Proveedor.list') }}",
                dataType: 'json',
                success: function(res){
                    $('#id_prov').empty();
                    for (const dataValue of res) {
                        $('#id_prov').append("<option value='"+dataValue.id+"' selected>"+dataValue.nombre+"</option>");
                    }
                    $('#id_prov').val({{$articulo->id_prov}});
                }
            });

        });
    </script>
@endpush
