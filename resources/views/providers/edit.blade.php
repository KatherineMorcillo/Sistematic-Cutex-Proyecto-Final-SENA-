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
                                            <h4>Editar Proveedor</h4>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-------------------->
                        </div>
                        <div class="card-body">
                            <form action="{{route('proveedores.actualizar', $provider->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <table class="table table-centered table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nombre comercial  <b style="color:red">*</b> </th>
                                            <td><input type="text" class="form-control" name="business_name" value="{{ $provider->business_name }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Nombre del administrador <b style="color:red">*</b> </th>
                                            <td><input type="text" class="form-control" name="admin_name" value="{{ $provider->admin_name }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Teléfono <b style="color:red">*</b> </th>
                                            <td><input type="text" class="form-control" name="cellphone" value="{{ $provider->cellphone }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Correo electrónico <b style="color:red">*</b> </th>
                                            <td><input type="email" class="form-control" name="email" value="{{ $provider->email }}" required></td>
                                        </tr>
                                        <tr>
                                            <th>Dirección <b style="color:red">*</b></th>
                                            <td><input type="text" class="form-control" name="address" value="{{ $provider->address }}" required></td>
                                        </tr>
                                
                                
                                        <br>
                                        <br>
                                        <tr> 
                                            <th>
                                                <div class="button-list">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Actualizar
                                                    </button>
                                                    <a  href= "{{ route('proveedores') }}" class="btn btn-danger waves-effect waves-light">
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
