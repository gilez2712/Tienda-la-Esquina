@extends('layout.template')

@section('content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h5>Listado de productos</h5>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-info" href="{{ route('Usuario.create') }}">
                        <i class="fa fa-plus"></i>
                        Dar de Alta Usuario
                    </a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-hover table-bordered cell-border table-responsive row-border" id="datatable-crud">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">

        const onDelete = (elemento) => {
            Swal.fire(
                {
                    title: 'Desea borrar el registro',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    denyButtonText: `No`,
                    icon: 'question'
                }
            ).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let id = $(elemento).data('id');

                    $.ajax({
                        type:"POST",
                        url: "{{ route('Usuario.eliminar') }}",
                        data: { id: id},
                        dataType: 'json',
                        success: function(res){
                            Swal.fire('Borrado!', '', 'success')
                            var oTable = $('#datatable-crud').dataTable();
                            oTable.fnDraw(false);
                        }
                    });

                } else if (result.isDenied) {
                    //Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }



        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#datatable-crud').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{url('assets/es-ES.json')}}",
                },
                ajax: "{{ url('Usuario') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'tipo', name: 'tipo'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'asc']]
            });

        });
    </script>
@endpush
