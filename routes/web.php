<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);


//loguin and register

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('usuarios');
    })->name('dashboard');
    Route::impersonate();
    //Perfil de usuario
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    //Actualizar Usuarios
    Route::put('perfil/{id}/editar', [ProfileController::class, 'update'])->name('perfil.editar');

    //Proveedores
    //listar Proveedor
    Route::get('proveedores', [ProvidersController::class, 'index'])->name('proveedores');
    //Crear Proveedor
    Route::get('proveedores/crear', [ProvidersController::class, 'create'])->name('proveedores.crear');
    //Guardar Proveedor
    Route::post('proveedores', [ProvidersController::class, 'store'])->name('proveedores.guardar');
    //Eliminar Proveedor
    Route::delete('proveedores/{id}', [ProvidersController::class, 'destroy'])->name('proveedores.eliminar');
    //Detalles Proveedor
    Route::get('proveedores/{id}', [ProvidersController::class, 'show'])->name('proveedores.detalles');
    //Editar Proveedor
    Route::get('proveedores/{id}/editar', [ProvidersController::class, 'edit'])->name('proveedores.editar');
    //Actualizar Proveedor
    Route::put('proveedores/{id}', [ProvidersController::class, 'update'])->name('proveedores.actualizar');
    //Actualizar status Proveedor
    Route::put('proveedores-status/{id}', [ProvidersController::class, 'editStatus'])->name('proveedores.estado');

    //Productos
    //listar Productos
    Route::get('productos', [ProductsController::class, 'index'])->name('productos');
    //Crear Productos
    Route::get('productos/crear', [ProductsController::class, 'create'])->name('productos.crear');
    //Guardar Productos
    Route::post('productos', [ProductsController::class, 'store'])->name('productos.guardar');
    //Eliminar Productos
    Route::delete('productos/{id}', [ProductsController::class, 'destroy'])->name('productos.eliminar');
    //Detalles Productos
    Route::get('productos/{id}', [ProductsController::class, 'show'])->name('productos.detalles');
    //Editar Productos
    Route::get('productos/{id}/editar', [ProductsController::class, 'edit'])->name('productos.editar');
    //Actualizar Productos
    Route::put('productos/{id}', [ProductsController::class, 'update'])->name('productos.actualizar');
    //Actualizar status Productos
    Route::put('productos-status/{id}', [ProductsController::class, 'editStatus'])->name('productos.estado');

    //Usuarios
    //listar Usuarios
    Route::get('usuarios', [UsersController::class, 'index'])->name('usuarios');
    //Crear Usuarios
    Route::get('usuarios/crear', [UsersController::class, 'create'])->name('usuarios.crear');
    //Guardar Usuarios
    Route::post('usuarios', [UsersController::class, 'store'])->name('usuarios.guardar');
    //Eliminar Usuarios
    Route::delete('usuarios/{id}', [UsersController::class, 'destroy'])->name('usuarios.eliminar');
    //Detalles Usuarios
    Route::get('usuarios/{id}', [UsersController::class, 'show'])->name('usuarios.detalles');
    //Editar Usuarios
    Route::get('usuarios/{id}/editar', [UsersController::class, 'edit'])->name('usuarios.editar');
    //Actualizar Usuarios
    Route::put('usuarios/{id}', [UsersController::class, 'update'])->name('usuarios.actualizar');
    //Actualizar status Usuarios
    Route::put('usuarios-status/{id}', [UsersController::class, 'editStatus'])->name('usuarios.estado');

    //Clientes
    //listar Clientes
    Route::get('clientes', [ClientsController::class, 'index'])->name('clientes');
    //Crear Clientes
    Route::get('clientes/crear', [ClientsController::class, 'create'])->name('clientes.crear');
    //Guardar Clientes
    Route::post('clientes', [ClientsController::class, 'store'])->name('clientes.guardar');
    //Eliminar Clientes
    Route::delete('clientes/{id}', [ClientsController::class, 'destroy'])->name('clientes.eliminar');
    //Detalles Clientes
    Route::get('clientes/{id}', [ClientsController::class, 'show'])->name('clientes.detalles');
    //Editar Clientes
    Route::get('clientes/{id}/editar', [ClientsController::class, 'edit'])->name('clientes.editar');
    // Ver Facturas
    Route::get('clientes/{id}/facturas', [ClientsController::class, 'invoice'])->name('clientes.facturas');
    //Actualizar Clientes
    Route::put('clientes/{id}', [ClientsController::class, 'update'])->name('clientes.actualizar');


    //Facturas
    //listar Facturas
    Route::get('facturas', [InvoicesController::class, 'index'])->name('facturas');
    //Crear Facturas
    Route::get('facturas/crear', [InvoicesController::class, 'create'])->name('facturas.crear');
    //Guardar Facturas
    Route::post('facturas', [InvoicesController::class, 'store'])->name('facturas.guardar');
    //Eliminar Facturas
    Route::delete('facturas/{id}', [InvoicesController::class, 'destroy'])->name('facturas.eliminar');
    //Detalles Facturas
    Route::get('facturas/{id}', [InvoicesController::class, 'show'])->name('facturas.detalles');
    //Editar Facturas
    Route::get('facturas/{id}/editar', [InvoicesController::class, 'edit'])->name('facturas.editar');
    //Actualizar Facturas
    Route::put('facturas/{id}', [InvoicesController::class, 'update'])->name('facturas.actualizar');
    //Actualizar status Facturas
    Route::put('facturas-status/{id}', [InvoicesController::class, 'editStatus'])->name('facturas.estado');

    //Colores
    //Listar colores
    Route::get('colores', [ColorsController::class, 'index'])->name('colores');
    //Crear Color
    Route::get('colores/crear', [ColorsController::class, 'create'])->name('colores.crear');
    //Guardar Color
    Route::post('colores', [ColorsController::class, 'store'])->name('colores.guardar');
    //Eliminar Color
    Route::delete('colores/{id}', [ColorsController::class, 'destroy'])->name('colores.eliminar');
    //Detalles Color
    Route::get('colores/{id}', [ColorsController::class, 'show'])->name('colores.detalles');
    //Editar Color
    Route::get('colores/{id}/editar', [ColorsController::class, 'edit'])->name('colores.editar');
    //Actualizar Color
    Route::put('colores/{id}', [ColorsController::class, 'update'])->name('colores.actualizar');
    //Actualizar status Color
    Route::put('colores-status/{id}', [ColorsController::class, 'editStatus'])->name('colores.estado');

    //Reportes
    Route::get('reportes', [ReportsController::class, 'index'])->name('reportes');
    Route::get('obtenerReportes', [ReportsController::class, 'getReports'])->name('obtenerReportes');

    //Notificaciones
    Route::get('notificaciones', [NotificationController::class, 'index'])->name('notificaciones');
    Route::get('notificaciones/contar', [NotificationController::class, 'count'])->name('notificaciones.contar');
});
