@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

<div class="row">
    <div class="col-12 me-2">
        <div class="card me-2">
            <div class="row-mb-2">
                <div class="col-2">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <h4>Lista de Notificaciones</h4>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-12 table-responsive">
                    <div class="col-sm-12">
                        <table id="notificaciones"class="table table-striped table-bordered mb-5" style="width:100%">
                            <!--Inicio de Tabla notificaciones-->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Título </th>
                                    <th>Mensaje</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td> {{ $notification->id }}</td>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ $notification->message }}</td>
                                        <td>
                                            <div class="text-left">
                                                @if ($notification->type == 'product')
                                                <a href="{{ route('productos.detalles', $notification->reference) }}" class="me-2 btn btn-sm btn-info">Ver detalle </a>
                                                @elseif($notification->type == 'invoice')
                                                <a href="{{ route('facturas.detalles', $notification->reference) }}" class="me-2 btn btn-sm btn-info">Ver detalle </a>
                                                @endif
                                               
                                            </div>
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
                                $('#notificaciones').DataTable({
                                    "language": {
                                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                                    },
                                });
                
                            });
                        </script>
                    @endsection
                </div>


            </div>

        </div>

    </div>

</div>




@endsection
