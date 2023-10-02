@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header">
                    <h4>Perfil de usuario</h4>
                </div>

                <div class="card-body">

                    <form action="{{route('perfil.editar', $user->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Mi nombre </th>
                                    <td><input type="text" class="form-control" name="name" value="{{ $user->name }}" required></td>
                                </tr>
                                
                                <tr>
                                    <th>Mi correo electrónico </th>
                                    <td><input type="email" class="form-control" name="email" value="{{ $user->email }}" required></td>
                                </tr>
                                 
                                <th>
                                    <div class="button-list">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Actualizar
                                        </button>
                                        <a  href= "{{ route('usuarios') }}" class="btn btn-danger waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Cancelar
                                        </a>
                                    </div>

                                </th>
                             
                            </thead>
                        </table>
                    </form>
                
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
