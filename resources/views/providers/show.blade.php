@extends('layouts.app')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-success border mb-3">
                    <div class="card-header"></div>
                    <h1 class="ms-3">Detalles del proveedor</h1>
                    <div class="card-body">
                        <table class="table table-centered table-nowrap table-hover mb-0">
        
                            <!--Inicio de Tabla Detalles-->
                            <tr>
                                <th>Nombre comercial</th>
                                <td>{{ $provider->business_name }}</td>
                            </tr>
                            <tr>
                                <th>Nombre del administrador</th>
                                <td>{{ $provider->admin_name }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $provider->cellphone }}</td>
                            </tr>
                            <tr>
                                <th>Correo electrónico</th>
                                <td>{{ $provider->email }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $provider->address }}</td>
                            </tr>
                            <tr>
                                <th>Productos asociados al proveedor</th>
                                <td>
                                   @foreach ( $products as $product )
                                     <p>{{ $product->name }}</p> 
                                   @endforeach 
                                </td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td>{{ $provider-> status  }}</td>
                            </tr>

                            
                            
                        </table>
                        <br>
                            <br>
                        <div class="button-list">
        
                            <a  href="{{ route('proveedores') }}"  type="submit" class="btn btn-danger waves-effect waves-light">
                                <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
