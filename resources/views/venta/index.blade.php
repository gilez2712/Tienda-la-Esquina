@extends('layout.template')

@section('content')

    @if ($venta = Session::get('success'))
        <div class="alert alert-success">
            <p class="text-start">
                La venta se realizó correctamente, ID: {{$venta['venta']['id']}}
            </p>
        </div>
    @endif
    <div class="container">

        <div class="row">
            <div class="col-md-4 mt-3">
                <button class="btn btn-primary" id="buttonBuscar" onclick="buscarProducto()">
                    <i class="fa fa-search"></i>
                    Buscar Productos
                </button>
            </div>
        </div>

        <form method="post" action="{{route('Venta.store')}}">
            @csrf
            <div class="row mt-3">
                <table id="tableProducto" class="table" width="100%">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody id="bodyProducto">

                    </tbody>
                </table>
            </div>


        <div class="mt-5">
            <input type="number" class="form-control" value="0" name="total" id="total" readonly>
        </div>

        <button class="btn btn-info" type="submit">
            <i class="fa fa-plus"></i>
            Terminar venta
        </button>

        </form>
    </div>

    <div class="modal fade " id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buscar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center" id="contenido">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        const modalProducto = $('#modalProducto');
        const contenido = $('#contenido');
        const body_table = $('#bodyProducto');
        const myTable = $('#tableProducto');
        const total_in = $('#total');
        let total = 0;

        const buscarProducto = () => {
          modalProducto.modal('show');
            $.ajax({
                url: "{{url('Venta-Lista')}}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    contenido.html('');
                    for (const datum of data) {
                        const url = '{{url('')}}/' + datum.imagen;
                        const id = datum.id;
                        const nombre = datum.nombre;
                        const descripcion = datum.descripcion;
                        const precio = datum.precio_venta;
                        const existencia = datum.stock;

                        const tarjeta = '<div class="col-md-3">'+
                            '<div class="card align-items-center" >' +
                            '<img src="'+url+'" class="card-img-top" ' +
                            'style="width: 70px; height: 70px">' +
                            '<div class="card-body">' +
                            '<h6 class="card-title">'+nombre+'</h6>' +
                            '<p class="card-text">' + descripcion +'</p>' +
                            '<p class="card-text">$ ' + precio +'</p>' +
                            '<p class="card-text">Existencias ' + existencia +'</p>' +
                            '<p class="card-text"> <button class="btn btn-success" data-json=\''+JSON.stringify(datum)+'\' onclick="agregarProducto(this)">' +
                            'Agregar' +
                            '</button></p>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        contenido.append(tarjeta);
                    }

                }
            });


        }

        const calcular = () => {
            const precio_v = $('.precio_venta');
            const existencia = $('.existencia');
            const stock = $('.stock');
            const _total = $('._total');
            total = 0;

            $.each(precio_v, (i, val) => {
                const p = Number($(precio_v[i]).val());
                let e = Number($(existencia[i]).val());
                let res = p * e;

                if (e > Number($(stock[i]).val())){
                    e = Number($(stock[i]).val());
                    res = p * e;
                }
                if(e <= 0){
                    e= 1;
                    res = p * e;
                }

                $(_total[i]).val(res);
                $(existencia[i]).val(e);

                total += res;
            });

            total_in.val(total);

        };

        const agregarProducto = (producto) => {
            producto = JSON.parse($(producto).attr('data-json'));
            const id = producto.id;
            if ($('#tr_'+id).length > 0){
                Swal.fire(
                    'PRODUCTO YA AGREGADO',
                    'El producto ya se encuentra agregado',
                    'info'
                );
                return;
            }

            const html = '<tr id="tr_'+id+'" onclick="calcular()" onchange="calcular()">' +
                '<td> '+producto.nombre+'</td>'+
                '<td> <input type="hidden" class="form-control producto" name="inventario[]" id="inventario'+id+'" value="'+producto.id+'">' +
                '<input readonly type="number" class="form-control precio_venta" name="precio_venta[]" id="precio_venta'+id+'" value="'+producto.precio_venta+'"></td>'+
                '<td><input type="number" class="form-control stock" name="stock[]" id="stock'+id+'" value="'+producto.stock+'" readonly></td>'+
                '<td><input type="number" class="form-control existencia" name="existencia[]" id="existencia'+id+'" value="1"></td>'+
                '<td><input type="number" class="form-control _total" name="total_p[]" id="total'+id+'" value="'+producto.precio_venta+'" readonly></td>'+
                '<td><button type="button" class="btn btn-danger btn-sm btn-delete" data-id="'+id+'" ><i class="fa fa-trash"></i>Borrar</button></td>'+
                '</tr>';

            body_table.append(html);

            modalProducto.modal('hide');
            calcular();
        }

        myTable.on('click','.btn-delete', function () {
            $(this).closest('tr').remove();
            calcular();
        });

        $(document).ready(() => {
            @if(isset($venta))
            let json = '@php(print json_encode($venta))';
            let id = JSON.parse(json).venta.id;

            $.ajax({
                url: "{{url('Venta/Ticket/'.$venta['venta']['id'])}}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if(data.ticket !== ''){
                        const window_print =  window.open(' ', 'popimpr');
                        window_print.document.write(data.ticket);
                        setTimeout(function () {
                            window_print.print();
                            window_print.close();
                        }, 1000);
                    }
                }
            });

            @endif
        });

    </script>

@endpush