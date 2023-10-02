@extends('layouts.app')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="card border-warning border mb-3 mt-5">
                        <div class="row ">
                              <!--Título Editar proveedor-->
                            <div class="col-2">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <h4>Editar Producto</h4>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-------------------->
                        </div>
                        <div class="card-body">
                            <form action="{{route('facturas.actualizar', $invoice->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Hora</th>
                                            <td><input type="text" class="form-control" name="date_hour" value="{{ $invoice->date_hour }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><input type="text" class="form-control" name="total" value="{{ $invoice->total }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Usuario</th>
                                            <td><input type="text" class="form-control" name="user_id" value="{{ $invoice->user_id }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Cliente</th>
                                            <td><input type="number" class="form-control" name="client_id" value="{{ $invoice->client_id }}" required></td>
                                        </tr>                               
                                        <br>
                                        <br>
                                        <tr> 
                                            <th>
                                                <div class="button-list">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Actualizar
                                                    </button>
                                                    <a  href= "{{ route('facturas') }}" class="btn btn-danger waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Cancelar
                                                    </a>
                                                </div>

                                            </th>
                                        </tr>
                                        
                                     </thead>
                                    </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection