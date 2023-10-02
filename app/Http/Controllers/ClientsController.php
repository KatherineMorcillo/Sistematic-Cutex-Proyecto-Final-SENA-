<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Document;
use App\Models\User;

class ClientsController extends Controller
{
    //Listar clientes
    public function index()
    {
        //ORM Eloquent
        $clients = Client::all();
        $documents = Document::all();
        //select * from providers
        //me retorna la información en formato json
        return view('clients.index', compact('clients', 'documents'));
    }
    public function store(Request $request)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Cliente creado correctamente');

        Client::create($request->all());
        return redirect()->route('clientes')->with('message', session('success'));
    }
    //Eliminar--> retorno vista clientes
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect()->route('clientes');
    }
    //mostrar detalles
    public function show($id)
    {
        $client = Client::find($id);
        $documents = Document::all();
        return view('clients.show', compact('client', 'documents'));
    }
    //editar
    public function edit($id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }
    //facturas
    public function invoice($id)
    {
        $client = Client::find($id);
        $invoices = Invoice::join('users', 'invoices.user_id', '=', 'users.id')
            ->where('invoices.client_id', $id)
            ->select('invoices.*', 'users.name as user_name', 'users.surname as user_surname')
            ->get();

        return view('clients.invoice', compact('invoices', 'client'));
    }
    //actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Cliente ac
        
        tualizado correctamente');

        $client = Client::find($id)->update($request->all());
        return redirect()->route('clientes')->with('message', session('success'));;
    }
}
