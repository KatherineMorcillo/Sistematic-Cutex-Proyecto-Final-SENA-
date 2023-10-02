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
                                <ol class="breadcrumb m-0">
                                    <h4>Lista de Facturas</h4>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!--Botón Crear-->
                    <div class="text-sm-end">
                        <a href="{{ route('facturas.crear') }}" class="btn btn-danger waves-effect waves-light mt-3 mb-2"
                            ><i class="mdi mdi-plus-circle me-1"></i> Crear Factura</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table id="facturas"class="table table-striped table-bordered mb-5" style="width:100%">

                            <!--Inicio de Tabla crear-->
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>Cliente</th>
                                    <th>Hora</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th style="width: 82px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td> {{ $invoice->id }}</td>
                                        <td class="table-user">
                                            <a href="{{ route('facturas.detalles', $invoice->id) }}"
                                                class="text-body fw-semibold">{{ $invoice->client_names }} {{ $invoice->client_surnames }}</a>
                                        </td>
                                        <td>{{ $invoice->date_hour }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>
                                        <span style="border: none !important; background: transparent"
                                                    >
                                                    @if ($invoice->status === 'active')
                                                        <span class="badge text-bg-success">Creada</span>
                                                    @else
                                                        <span class="badge text-bg-danger">Cancelada</span>
                                                    @endif
                                                </span>
                                        </td>
                                        <td class="d-flex">
                                            <form id="formDeleted{{ $invoice->id }}"
                                                action="{{ route('facturas.eliminar', $invoice->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            <button class="btn btn-danger btn-sm" onclick="deleted({{$invoice->id}})">
                                                Cancelar
                                            </button>
                                        </td>
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
                                $('#facturas').DataTable({
                                    order: [[0, 'desc']],
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
                                    confirmButtonText: '¡Sí, cancelar!',
                                    cancelButtonText: 'No, cancelar!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
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



<!-- Modal Crear -->
<div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Crear Factura</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('facturas.guardar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Hora</label>
                        <input type="text" class="form-control" name="date_hour" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Total</label>
                        <input type="text" class="form-control" name="total" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Usuario</label>
                        <select name="user_id" id="" class="form-select">
                            <option value="">Seleccionar...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->names}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Cliente</label>
                        <select name="client_id" id="" class="form-select">
                            <option value="">Seleccionar...</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->names}}</option>
                            @endforeach
                        </select>
                    </div>         
                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal"
                            aria-label="Close">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection