@extends('layouts.app')
@section('content')
    <h1 class="my-4">Crear Factura</h1>
    <form id="formAgregarFactura">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clientes</h5>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <select id="clientId" name="client_id" class="form-select" required>
                                        <option value="">Seleccionar...</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->names }} {{ $client->surnames }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button id="createClient" type="button" class="btn btn-info">Crear</button>
                                </div>
                            </div>

                        </div>
                        <div id="formClient" class="row" style="display: none">
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Nombres <b style="color:red">*</b></label>
                                <input type="text" class="form-control" name="names">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="surnames">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Tipo Docuemnto <b style="color:red">*</b></label>
                                <select name="document_id" id="" class="form-select">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}">{{ $document->acronym }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="company" class="form-label">Numero Documento <b style="color:red">*</b></label>
                                <input type="number" class="form-control" name="document_number">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="exampleInputEmail1" class="form-label">Direccion</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="position" class="form-label">Numero Celular</label>
                                <input type="number" class="form-control" name="cellphone">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="position" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <div class="row">
                            <div class="col-3">
                                <label for="name" class="form-label">Cantidad <b style="color:red">*</b> </label>
                                <select id="cantidadProducto" name="ammount" id="" class="form-select"
                                    disabled>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="name" class="form-label">Producto o referencia <b style="color:red">*</b> </label>
                                <select id="productoSeleccionado" name="productSelect" id="" class="form-select">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->reference }}-{{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="name" class="form-label">Total</label>
                                <input id="totalProducto" type="text" class="form-control" disabled>
                            </div>
                            <div class="col-3 d-flex align-items-end">
                                <button type="button" onclick="addProduct()"
                                    class="btn btn-success waves-effect waves-light">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered mb-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Nombre</th>
                                    <th>Precio unitario</th>
                                    <th>Precio total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="addProductSelect"></tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Total Factura</th>
                                    <th id="totalInvoice"></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-12 d-flex justify-end">
                <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                <a href="{{ route('facturas') }}" class="btn btn-danger waves-effect waves-light"
                    >Cancelar</a>
            </div>
        </div>
    </form>
@section('js')
    <script>
        const buttonEvent = document.getElementById('createClient')

        buttonEvent.addEventListener('click', function() {
            const formClient = document.getElementById('formClient')
            const selectClientId = document.getElementById('clientId')

            formClient.style.display = 'flex';
            selectClientId.required = false
        })

        const selectClientId = document.getElementById('clientId')

        selectClientId.addEventListener('change', function(event) {
            const formClient = document.getElementById('formClient')
            selectClientId.required = true

            formClient.style.display = 'none';
        })

        // defenir variables
        let productsSelect = []
        let productos = {!! json_encode($products) !!}

        // voleres que cambian cuando se seleccionan

        const productoSeleccionado = document.getElementById('productoSeleccionado')
        const cantidadProducto = document.getElementById('cantidadProducto')
        const totalProducto = document.getElementById('totalProducto')
        const tableAddProductos = document.getElementById("addProductSelect");
        const totalInvoice = document.getElementById('totalInvoice')

        productoSeleccionado.addEventListener('change', function() {
            totalProducto.value = ''

            while (cantidadProducto.options.length > 0) {
                cantidadProducto.remove(0);
            }

            const getStockProduct = productos.find((t) => t.id === parseInt(productoSeleccionado.value))

            cantidadProducto.disabled = false;

            var opcion = document.createElement("option");
            opcion.value = '';
            opcion.text = 'Seleccionar...';
            cantidadProducto.appendChild(opcion);

            for (let i = 0; i < getStockProduct.stockDetail; i++) {
                var opcion = document.createElement("option");
                opcion.value = i + 1;
                opcion.text = i + 1;
                cantidadProducto.appendChild(opcion);

            }

        })

        cantidadProducto.addEventListener('change', function() {

            const getStockProduct = productos.find((t) => t.id === parseInt(productoSeleccionado.value))

            totalProducto.value = getStockProduct.price * parseInt(cantidadProducto.value)

        })

        // agregar producto a el carrito
        function addProduct() {

            if (!productoSeleccionado.value) {
                alert('Escoje un producto')
                return
            }

            if (!cantidadProducto.value) {
                alert('Seleccione cantidad del producto')
                return
            }


            const productoAgregar = productos.find((t) => t.id === parseInt(productoSeleccionado.value))

            tableAddProductos.innerHTML = ""

            // saber si existe el producto para no volver a agregar solo actualizar cantidad

            const existProductSelect = productsSelect.findIndex((l) => l.productId === productoAgregar.id)

            console.log(existProductSelect)

            if (existProductSelect >= 0) {
                productsSelect[existProductSelect].ammount = parseInt(productsSelect[existProductSelect].ammount) +
                    parseInt(cantidadProducto.value)
                productsSelect[existProductSelect].totalPrice = parseInt(productsSelect[existProductSelect].totalPrice) +
                    parseInt(totalProducto.value)

            } else {
                productsSelect.push({
                    ammount: cantidadProducto.value,
                    name: productoAgregar.name,
                    price: productoAgregar.price,
                    totalPrice: totalProducto.value,
                    productId: productoAgregar.id
                })
            }


            let sum = 0

            for (let i = 0; i < productsSelect.length; i++) {

                var row = document.createElement("tr");

                for (var key in productsSelect[i]) {
                    var cell = document.createElement("td");

                    if (key === 'totalPrice') {
                        sum += parseInt(productsSelect[i][key]);
                        cell.textContent = productsSelect[i][key];
                    } else if (key === 'productId') {
                        var button = document.createElement("button");
                        button.textContent = "Eliminar";
                        button.type = "button";
                        button.classList.add("btn", "btn-danger", "btn-sm");
                        button.addEventListener("click", function() {
                            deletedProduct(productsSelect[i].productId);
                        });
                        cell.appendChild(button);
                    } else {
                        cell.textContent = productsSelect[i][key];
                    }

                    row.appendChild(cell);
                }

                tableAddProductos.appendChild(row);

            }



            totalInvoice.innerHTML = sum


            cantidadProducto.disabled = true

            productoSeleccionado.value = ''

            totalProducto.value = ''

            // restar stock o eliminar producto

            productos = productos.map((mp) => {
                if (mp.id === productoAgregar.id) {
                    mp.stockDetail = parseInt(mp.stockDetail) - parseInt(cantidadProducto.value)
                }
                return mp
            }).filter((fl) => fl.stockDetail > 0)

            cantidadProducto.value = ''

            while (productoSeleccionado.options.length > 0) {
                productoSeleccionado.remove(0);
            }

            var opcion = document.createElement("option");
            opcion.value = '';
            opcion.text = 'Seleccionar...';
            productoSeleccionado.appendChild(opcion);

            for (let i = 0; i < productos.length; i++) {
                var opcion = document.createElement("option");
                opcion.value = productos[i].id;
                opcion.text = productos[i].reference + '-' + productos[i].name;
                productoSeleccionado.appendChild(opcion);
            }

        }

        function deletedProduct(id) {

            productsSelect = productsSelect.filter((t) => t.productId != id)


            tableAddProductos.innerHTML = ""

            console.log('id', id, productsSelect)

            let sum = 0

            for (let i = 0; i < productsSelect.length; i++) {

                var row = document.createElement("tr");

                for (var key in productsSelect[i]) {
                    var cell = document.createElement("td");

                    if (key === 'totalPrice') {
                        sum += parseInt(productsSelect[i][key]);
                        cell.textContent = productsSelect[i][key];
                    } else if (key === 'productId') {
                        var button = document.createElement("button");
                        button.textContent = "Eliminar";
                        button.type = "button";
                        button.classList.add("btn", "btn-danger", "btn-sm");
                        button.addEventListener("click", function() {
                            deletedProduct(productsSelect[i].productId);
                        });
                        cell.appendChild(button);
                    } else {
                        cell.textContent = productsSelect[i][key];
                    }

                    row.appendChild(cell);
                }

                tableAddProductos.appendChild(row);

            }

            totalInvoice.innerHTML = sum
        }

        // guardar informacion

        const formAgregarFactura = document.getElementById('formAgregarFactura')

        formAgregarFactura.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = {
                _token: formAgregarFactura.elements._token.value,
                client_id: formAgregarFactura.elements.client_id.value,
                names: formAgregarFactura.elements.names.value,
                surnames: formAgregarFactura.elements.surnames.value,
                document_number: formAgregarFactura.elements.document_number.value,
                address: formAgregarFactura.elements.address.value,
                cellphone: formAgregarFactura.elements.cellphone.value,
                email: formAgregarFactura.elements.email.value,
                document_id: formAgregarFactura.elements.document_id.value,
                ammount: productsSelect
            }

            if(formData.client_id === '') {
                if (formData.names === '' || formData.document_number === '' || formData.document_id === '') {
                    alert('Porfavor revisa la informacion')
                    return
                }
            }

            if (productsSelect.length === 0) {
                alert('Selecciona productos')
                return
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                }
            });


            $.ajax({
                url: '/facturas',
                type: 'POST',
                data: JSON.stringify(formData),
                success: function(response) {
                    console.log(response)
                    // Realizar acciones con la respuesta del servidor
                    window.location.href = '/facturas'
                },
                error: function(xhr, status, error) {
                    // Manejar errores
                    console.log(xhr.responseText);
                }
            });

            // formAgregarFactura.reset();
        })
    </script>
@endsection
@endsection
