<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProvidersController extends Controller
{
    //listar Proveedor
    public function index()
    {
        //ORM Eloquent
        $providers = Provider::all();
        //select * from providers
        //me retorna la información en formato json
        return view('providers.index', compact('providers'));
    }
    //crear
    // public function create()
    // {
    //     return view('providers.create');
    // }
    //(guardar datos y retornar proveedores)
    public function store(Request $request)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Proveedor creado correctamente');

        Provider::create($request->all());
        return redirect()->route('proveedores')->with('message', session('success'));
    }
    //Eliminar--> retorno vista proveedores
    public function destroy($id)
    {
        Provider::find($id)->delete();
        return redirect()->route('proveedores');
    }
    //mostrar detalles
    public function show($id)
    {
        $provider = Provider::find($id);
        $products = Product::query()
            ->where('provider_id', '=', $id)
            ->get();
        return view('providers.show', compact('provider', 'products'));
    }
    //editar
    public function edit($id)
    {
        $provider = Provider::find($id);

        return view('providers.edit', compact('provider'));
    }
    //editar status
    public function editStatus($id)
    {
        $provider = Provider::find($id);

        if ($provider->status === 'active') {
            Provider::find($id)->update(["status" => "inactive"]);
        } else {
            Provider::find($id)->update(["status" => "active"]);
        }

        return redirect()->route('proveedores');
    }
    //actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Proveedor actualizado correctamente');

        $provider = Provider::find($id)->update($request->all());
        return redirect()->route('proveedores')->with('message', session('success'));;
    }
}
