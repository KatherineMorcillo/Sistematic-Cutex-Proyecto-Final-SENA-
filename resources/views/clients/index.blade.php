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
                                    <h4>Lista de Clientes</h4>
                                </ol>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->rol_id!= 3)
                        <!--Botón Crear-->
                        <div class="text-sm-end">
                            <a href="{{ route('facturas.crear')  }}"class="btn btn-danger waves-effect waves-light mt-3 mb-2"
                               ><i
                                    class="mdi mdi-plus-circle me-1"></i> Crear Cliente
                            </a>
                        </div>
                    @endif

                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table id="clients"class="table table-striped table-bordered mb-5" style="width:100%">

                            <!--Inicio de Tabla crear-->
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Teléfono </th>
                                    <th>Correo electrónico</th>
                                    <th>Facturas asociadas</th>
                                    @if (Auth::user()->rol_id!= 3)
                                    <th style="width: 82px;">Acciones</th>
                                   @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td> {{ $client->id }}</td>
                                        <td class="table-user">
                                            <a href="{{ route('clientes.detalles', $client->id) }}"
                                                class="text-body fw-semibold">{{ $client->names }}
                                            </a>
                                        </td>
                                        <td>{{$client->cellphone}}</td>
                                        <td>{{ $client->email }}</td>
                                        <td >
                                            <a href="{{route('clientes.facturas',$client->id)}}">Ver facturas</a>
                                        </td>
                                        @if (Auth::user()->rol_id != 3)
                                            <td>
                                                <form id="formDeleted{{ $client->id }}"
                                                    action="{{ route('clientes.eliminar', $client->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf 
                                                    
                                                    <a class="me-2 btn btn-sm btn-info"
                                                    href="{{ route('clientes.editar', $client->id) }}"
                                                    class="action-icon">
                                                    Editar</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleted({{ $client->id }})">
                                                    Eliminar
                                                </button>
                                                </form>
                                               
                                            </td>
                                        @endif
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

<!-- Modal Crear -->
<div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Crear Cliente</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('clientes.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombres </label>
                            <input type="text" class="form-control" name="names" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Apellidos </label>
                            <input type="text" class="form-control" name="surnames" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Telefono </label>
                            <input type="text" class="form-control" name="cellphone" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tipo de documento</label>
                            <select name="document_id" id="" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach($documents as $document)
                                    <option value="{{ $document->id }}">{{ $document->acronym}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label">Número Documento</label>
                            <input type="number" class="form-control" name="document_number" required>
                        </div>


                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"
                            data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
