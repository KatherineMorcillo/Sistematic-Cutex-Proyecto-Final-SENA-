@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

    <div class="row ">
        <div class="col-12 me-2">
            <div class="card me-2">
                <div class="row-mb-2">
                    <div class="col-2">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                    <h4>Lista de facturas del cliente: </h4>
                                    <h4>{{ $client->names }} {{ $client->surnames }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table id="clients"class="table table-striped table-bordered mb-5" style="width:100%">

                            <!--Inicio de Tabla crear-->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Hora</th>
                                    <th>Creado por:</th>
                                    <th>Total</th>  
                                    <th></th>                            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td> {{ $invoice->id }}</td>
                                        <td>{{ $invoice->date_hour }}</td>
                                        <td>{{ $invoice->user_name }} {{  $invoice->user_surname }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td><a href="{{ route('facturas.detalles',$invoice->id) }}">Ver Detalle</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @section('js')
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#clients').DataTable({
                                    "language": {
                                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                                    },
                                });

                            });
                        </script>
                        <script>
                            function deleted(id) {
                                const form = document.getElementById('formDeleted' + id);
                                console.log(form);
                                Swal.fire({
                                    title: '¿Estás seguro?',
                                    text: "¡No podrás revertir esto!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡Sí, bórralo!',
                                    cancelButtonText: 'No, cancelar!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                        Swal.fire(
                                            '¡Eliminado!',
                                            'El cliente ha sido eliminado.',
                                            'success'
                                        )
                                    }
                                })
                            }
                        </script>
                        <!--alerta-->
                        @if (session('success'))
                            <script type="text/javascript">
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: '{{ session('success') }}',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            </script>
                        @endif
                    @endsection
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
