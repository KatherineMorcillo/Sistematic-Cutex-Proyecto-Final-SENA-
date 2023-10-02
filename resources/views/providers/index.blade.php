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
                                    <h4>Lista de Proveedores</h4>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!--Botón Crear-->
                    @if ( Auth::user()->rol_id ==1)
                    <div class="text-sm-end">
                        <button type="button" class="btn btn-danger waves-effect waves-light mt-3 mb-2" data-bs-toggle="modal"
                            data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Crear Proveedor</button>
                    </div>
                    @endif
                  
                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table id="proveedores"class="table table-striped table-bordered mb-5" style="width:100%">

                            <!--Inicio de Tabla crear-->
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>Nombre comercial</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    @if (Auth::user()->rol_id==1)
                                    <th style="width: 82px;">Acciones</th>
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($providers as $provider)
                                    <tr>
                                        <td> {{ $provider->id }}</td>
                                        <td class="table-user">
                                            <a href="{{ route('proveedores.detalles', $provider->id) }}"
                                                class="text-body fw-semibold">{{ $provider->business_name }}</a>
                                        </td>
                                        <td>{{ $provider->address }}</td>
                                        <td>{{ $provider->cellphone }}</td>
                                        <td>
                                            <form action="{{ route('proveedores.estado', $provider->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button style="border: none !important; background: transparent"
                                                    type="submit">
                                                    @if ($provider->status === 'active')
                                                        <span class="badge text-bg-success">Activo</span>
                                                     @else
                                                        <span class="badge text-bg-danger">Inactivo</span>
                                                    @endif
                                                </button>

                                            </form>
                                        </td>
                                        @if (Auth::user()->rol_id==1)
                                        <td class="d-flex">
                                            <form id="formDeleted{{ $provider->id }}"
                                                action="{{ route('proveedores.eliminar', $provider->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf


                                            </form>
                                            <a class="me-2 btn btn-sm btn-info"
                                                href="{{ route('proveedores.editar', $provider->id) }}" class="action-icon">
                                                Editar</a>
                                               
                                                <button class="btn btn-danger btn-sm" onclick="deleted({{ $provider->id }})">
                                                    Eliminar
                                                </button>  
                                               
                                           
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
                                $('#proveedores').DataTable({
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
                                            'Su proveedor ha sido eliminado.',
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Crear Proveedor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('proveedores.guardar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre comercial <b style="color:red">*</b></label>
                        <input type="text" class="form-control" name="business_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del administrador <b style="color:red">*</b></label>
                        <input type="text" class="form-control" name="admin_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Teléfono <b style="color:red">*</b> </label> 
                        <input type="text" class="form-control" name="cellphone" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo electrónico <b style="color:red">*</b> </label>
                        <input type="email" class="form-control" name="email" placeholder="ejemplo@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Dirección <b style="color:red">*</b> </label>
                        <input type="text" class="form-control" name="address" required>
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
