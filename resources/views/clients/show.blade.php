@extends('layouts.app')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-success border mb-3">
                    <div class="card-header"></div>
                    <h1 class="ms-3">Detalles del cliente</h1>
                    <div class="card-body">
                        <table class="table table-centered table-nowrap table-hover mb-0">
        
                            <!--Inicio de Tabla Detalles-->
                            <tr>
                                <th>Nombres</th>
                                <td>{{ $client->names }}</td>
                            </tr>
                            <tr>
                                <th>Apellidos</th>
                                <td>{{ $client->surnames }}</td>
                            </tr>
                            <tr>
                                <th>Número Documento</th>
                                <td>{{ $client->document_number }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $client->address }}</td>
                            </tr>
                            <tr>
                                <th>Celular</th>
                                <td>{{ $client->cellphone }}</td>
                            </tr>
                            <tr>
                                <th>Correo electrónico</th>
                                <td>{{ $client->email}}</td>
                            </tr>
                        </table>
                        <br>
                            <br>
                        <div class="button-list">
        
                            <a  href="{{ route('clientes') }}"  type="submit" class="btn btn-danger waves-effect waves-light">
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
