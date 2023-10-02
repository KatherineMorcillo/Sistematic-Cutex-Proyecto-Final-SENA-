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
                                    <h4>Lista de Productos</h4>
                                </ol>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->rol_id != 2)
                        <!--Botón Crear-->
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-danger waves-effect waves-light mt-3 mb-2"
                                data-bs-toggle="modal" data-bs-target="#custom-modal"><i
                                    class="mdi mdi-plus-circle me-1"></i> Crear Producto</button>
                        </div>
                    @endif

                </div>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table id="productos"class="table table-striped table-bordered mb-5" style="width:100%">

                            <!--Inicio de Tabla crear-->
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>Imagen</th>
                                    <th>Nombre producto</th>
                                    <th>Cantidad disponible</th>
                                    <th>Referencia</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    @if (Auth::user()->rol_id != 2)
                                        <th style="width: 82px;">Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td> {{ $product->id }}</td>
                                        <td> <img height="100" width="100" src="{{ asset($product->photo) }}" alt=""> </td>
                                        <td class="table-user">
                                            <a href="{{ route('productos.detalles', $product->id) }}"
                                                class="text-body fw-semibold">{{ $product->name }}</a>
                                        </td>
                                        <td>{{$product->stock - $product->stockDetail}}</td>
                                        <td>{{ $product->reference }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td class="d-flex">
                                            <form
                                                action="{{ route('productos.estado', $product->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <button style="border: none !important; background: transparent"
                                                    type="submit">
                                                    @if ($product->status === 'active')
                                                        <span class="badge text-bg-success">Activo</span>
                                                    @else
                                                        <span class="badge text-bg-danger">Inactivo</span>
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                        @if (Auth::user()->rol_id != 2)
                                            <td>
                                                <form id="formDeleted{{ $product->id }}"
                                                    action="{{ route('productos.eliminar', $product->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
    
    
                                                </form>
                                                <a class="me-2 btn btn-sm btn-info"
                                                    href="{{ route('productos.editar', $product->id) }}"
                                                    class="action-icon">
                                                    Editar</a>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleted({{ $product->id }})">
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
                                $('#productos').DataTable({
                                    "language": {
                                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                                    },
                                });

                            });
                        </script>
                        <script>
                            function deleted(id) {
                                const form = document.getElementById('formDeleted' + id);
                               
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
                                            'Su producto ha sido eliminado.',
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
                          <!--alerta errores-->
                          @if (session('error'))
                          <script type="text/javascript">
                              Swal.fire({
                                  position: 'center',
                                  icon: 'error',
                                  title: '{{ session('error') }}',
                                  showConfirmButton: false,
                                  timer: 3500
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
                <h4 class="modal-title" id="myCenterModalLabel">Crear producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('productos.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Nombre producto <b style="color:red">*</b> </label>
                            <input type="text" class="form-control" name="name" required >
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Referencia <b style="color:red">*</b> </label>
                            <input type="text" class="form-control" name="reference" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="company" class="form-label">Descripción <b style="color:red">*</b> </label>
                            <textarea class="form-control" name="description" cols="30" rows="3" required></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="company" class="form-label">Cantidad <b style="color:red">*</b> </label>
                            <input type="number" class="form-control" name="stock" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Precio <b style="color:red">*</b> </label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Medida en pies (cueros y pieles) <b style="color:red">*</b></label>
                            <input type="number" class="form-control" name="measure" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Compañia <b style="color:red">*</b> </label>
                            <select name="company_id" id="" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Proveedor <b style="color:red">*</b> </label>
                            <select name="provider_id" id="" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->business_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Color <b style="color:red">*</b> </label>
                            <select name="color_id" id="" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                     
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Subcategoria <b style="color:red">*</b> </label>
                            <select name="subcategory_id" id="" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }} - {{ $subcategory-> categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">Imagen <b style="color:red">*</b></label>
                            <input type="file" class="form-control" name="file" required>
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
