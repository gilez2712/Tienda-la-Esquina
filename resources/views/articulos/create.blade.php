@extends('layout.template')

@section('content')
    @auth()
        <h3>Dar de alta un Articulo</h3>

        <form method="POST" action="{{route('Articulo.store')}}">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="" name="nombre" >
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="descripcion">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="cantidad">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">precio</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="precio">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">stock</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="stock">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">fecha_caducidad</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="" name="fecha_caducidad">
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
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">id_prov</label>
                <select name="id_prov" id="id_prov" class="form-control"></select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a type="button" class="btn btn-danger" href="{{route('Articulo.index')}}">Cancelar</a>
            </div>

        </form>


    @endauth
@endsection

@push('scripts')
    <script >

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
                }
            });

        });
    </script>

@endpush
