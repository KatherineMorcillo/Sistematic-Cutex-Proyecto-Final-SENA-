<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Client;
use App\Models\Document;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Detail;

class InvoicesController extends Controller
{
    ///listar Proveedor
    public function index()
    {

        //ORM Eloquent
        $invoices = Invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
            ->select('invoices.*', 'clients.names as client_names', 'clients.surnames as client_surnames')
            ->orderBy('invoices.id', 'desc')
            ->get();
        $users = User::all();
        $clients = Client::all();
        //select * from providers
        //me retorna la información en formato json
        return view('invoices.index', compact('invoices', 'users', 'clients'));
    }
    //crear
    public function create()
    {
        $products = Product::query()
            ->leftJoin('details', 'details.product_id', '=', 'products.id')
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->select('products.id', 'products.photo', 'products.name', 'products.reference', 'products.price', 'products.status', DB::raw('products.stock - SUM(IF(details.stock AND invoices.status = "active",details.stock,0)) as stockDetail'))
            ->groupBy('products.id', 'products.photo', 'products.name', 'products.reference', 'products.price', 'products.status', 'details.product_id', 'products.stock')
            ->where('products.status', '=', 'active')
            ->havingRaw('stockDetail > ?', [0])
            ->get();

        $clients = Client::all();
        $documents = Document::all();

        return view('invoices.create', compact('products', 'clients', 'documents'));
    }
    //(guardar datos y retornar proveedores)
    public function store(Request $request)
    {
        $details = [];
        $ammount = $request->input('ammount');
        $total = 0;

        foreach ($ammount as $price) {
            if ($price !== null) {
                $detailData = $price;
                $total += $detailData['ammount'] * $detailData['price'];
            }
        }

        if ($request->input('client_id') === null) {
            $clienSave =  Client::create([
                'names' => $request->input('names'),
                'surnames' => $request->input('surnames'),
                'cellphone' => $request->input('cellphone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'document_number' => $request->input('document_number'),
                'document_id' => $request->input('document_id'),
            ]);
        }

        $invoiceSave = Invoice::create([
            'date_hour' => now(),
            'total' => $total,
            'user_id' => Auth::user()->id,
            'client_id' => $request->input('client_id') === null ? $clienSave->id : $request->input('client_id')
        ]);

        foreach ($ammount as $ammountd) {
            if ($ammountd !== null) {
                $detail = $ammountd;
                $dataInsert = [
                    "price" => $detail['price'],
                    "stock" => $detail['ammount'],
                    "subtotal" => $detail['ammount'] * $detail['price'],
                    "product_id" => $detail['productId'],
                    "invoice_id" => $invoiceSave->id
                ];

                Detail::create($dataInsert);
            }
        }

        // Para notificaciones

        $users = User::all();
        foreach ($users as $user) {
            Notification::create([
                'title' => 'Se ha creado una factura',
                'message' => 'El usuario ' . Auth::user()->name . ' ha creado la factura ' . $invoiceSave->id,
                'type' => 'invoice',
                'reference' => $invoiceSave->id,
                'user_id' => $user['id']
            ]);
        }

        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Factura creada correctamente');

        return response('OK', 200);
        // return redirect()->route('facturas')->with('message', session('success'));
    }
    //Eliminar--> retorno vista proveedores
    public function destroy($id)
    {
        session()->flash('success', 'Factura cancelada correctamente');
        Invoice::find($id)->update(["status" => "inactive"]);
        return redirect()->route('facturas')->with('message', session('success'));
    }
    //mostrar detalles
    public function show($id)
    {
        $invoice = Invoice::join('users', 'invoices.user_id', '=', 'users.id')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->where('invoices.id', $id)
            ->select('invoices.*', 'users.name as user_names', 'users.surname as user_surnames', 'clients.names as client_names', 'clients.surnames as client_surnames')
            ->first();

        $products = Detail::join('products', 'details.product_id', '=', 'products.id')
            ->select('details.*', 'products.name as product_name')
            ->where('details.invoice_id', $id)
            ->get();

        return  view('invoices.show', compact('invoice', 'products'));
    }
    //editar
    public function edit($id)
    {
        $invoice = Invoice::find($id);

        return view('invoices.edit', compact('invoice'));
    }
    //editar status
    public function editStatus($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice->status === 'active') {
            Invoice::find($id)->update(["status" => "inactive"]);
        } else {
            Invoice::find($id)->update(["status" => "active"]);
        }

        return redirect()->route('facturas');
    }
    //actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Factura actualizado correctamente');

        $invoices = Invoice::find($id)->update($request->all());
        return redirect()->route('facturas')->with('message', session('success'));
    }
}
