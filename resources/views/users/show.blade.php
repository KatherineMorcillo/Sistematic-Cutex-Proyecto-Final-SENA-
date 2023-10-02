@extends('layouts.app')
@section('content')


<div class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-success border mb-3">
                    <div class="card-header">
                        <h1 class="ms-3">Detalles del usuario</h1> 
                        <h1 class="ms-3">{{ $user->name }}</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-centered table-nowrap table-hover mb-0">
        
                            <!--Inicio de Tabla Detalles-->
                            <tr>
                                <th>Compañia</th>
                                <td>
                                    @foreach($companies as $company)
                                        @if($user->company_id == $company->id)
                                            {{ $company->name }}
                                        @endif
                                    @endforeach

                                </td>
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Apellido</th>
                                <td>{{ $user->surname }}</td>
                            </tr>
                            <tr>
                                <th>Rol</th>
                                <td>
                                    @foreach($roles as $rol)
                                        @if($user->rol_id == $rol->id)
                                            {{ $rol->name }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Tipo de documento</th>
                                <td>
                                    @foreach($documents as $document)
                                        @if ($user->document_id == $document->id)
                                            {{ $document->name }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                          
                            <tr>
                                <th>Número documento</th>
                                <td>{{ $user->document_number }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $user->cellphone }}</td>
                            </tr>
                            <tr>
                                <th>Correo electrónico</th>
                                <td>{{ $user->email}}</td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td>{{ $user-> status }}</td>
                            </tr>
                            <tr>
                                <th>Género</th>
                                <td>{{ $user-> gender }}</td>
                            </tr>
                        </table>
                        <br>
                            <br>
                        <div class="button-list">
        
                            <a  href="{{ route('usuarios') }}"  type="submit" class="btn btn-danger waves-effect waves-light">
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
