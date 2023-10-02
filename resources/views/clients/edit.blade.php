@extends('layouts.app')
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="card border-warning border mb-3 mt-5">
                        <div class="row ">
                              <!--Título Editar cliente-->
                            <div class="col-2">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <h4>Editar Clientes</h4>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-------------------->
                        </div>
                        <div class="card-body">
                            <form action="{{route('clientes.actualizar', $client->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nombres </th>
                                            <td><input type="text" class="form-control" name="names" value="{{ $client->names }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Apellidos</th>
                                            <td><input type="text" class="form-control" name="surnames" value="{{ $client->surnames }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Número documento</th>
                                            <td><input type="number" class="form-control" name="document_number" value="{{ $client->document_number }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Dirección</th>
                                            <td><input type="text" class="form-control" name="address" value="{{ $client->address }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Teléfono</th>
                                            <td><input type="number" class="form-control" name="cellphone" value="{{ $client->cellphone }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Correo electrónico</th>
                                            <td><input type="email" class="form-control" name="email" value="{{ $client->email }}" required></td>
                                        </tr>   
                                                            
                                        <br>
                                        <br>
                                        <tr> 
                                            <th>
                                                <div class="button-list">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Actualizar
                                                    </button>
                                                    <a  href= "{{ route('clientes') }}" class="btn btn-danger waves-effect waves-light">
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