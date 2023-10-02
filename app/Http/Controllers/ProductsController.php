<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Provider;
use App\Models\Color;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    ///listar Proveedor
    public function index()
    {

        //ORM Eloquent
        $products = Product::query()
            ->leftJoin('details', 'details.product_id', '=', 'products.id')
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->select('products.id', 'products.photo', 'products.name', 'products.stock', 'products.reference', 'products.price', 'products.status', DB::raw('SUM(IF(details.stock AND invoices.status = "active",details.stock,0)) as stockDetail'))
            ->groupBy('products.id', 'products.photo', 'products.name', 'products.stock', 'products.reference', 'products.price', 'products.status', 'details.product_id')->get();
        $companies = Company::all();
        $providers = Provider::all();
        $colors = Color::all();
        $subcategories = Subcategory::query()
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.id', 'subcategories.name', 'categories.name as categoryName')
            ->get();


        $users = User::all();
        //select * from providers
        //me retorna la información en formato json
        return view('products.index', compact('products', 'companies', 'providers', 'colors', 'subcategories', 'users'));
    }
    //crear
    // public function create()
    // {
    //     return view('providers.create');
    // }
    //(guardar datos y retornar proveedores)
    public function store(Request $request)
    {
        $reference = $request['reference'];

        $exisProduct = Product::query()
            ->where('reference', '=', $reference)
            ->get();

        if (count($exisProduct) > 0) {
            session()->flash('error', 'Referencia ya registrada');
            return redirect()->route('productos')->with('message', session('error'));
        }
        $ultimoId = Product::latest()->first()->id;


        $image = $request->file('file');
        $extension = $image->getClientOriginalExtension();
        //$fileName = time() . "_" . $image->getClientOriginalName(); 
        $fileName = "producto_"  . $ultimoId + 1 . '.' . $extension;

        $image->move(public_path('images'), $fileName);

        $request['photo'] = "images/" . $fileName;
        $request['user_id'] = Auth::user()->id;
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Producto creado correctamente');

        $product = Product::create($request->all());

        $users = User::all();
        foreach ($users as $user) {
            Notification::create([
                'title' => 'Se ha creado un producto',
                'message' => 'El usuario ' . Auth::user()->name . ' ha creado el producto ' . $request['name'],
                'type' => 'product',
                'reference' => $product['id'],
                'user_id' => $user['id']
            ]);
        }
        return redirect()->route('productos')->with('message', session('success'));
    }
    //Eliminar--> retorno vista proveedores
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('productos');
    }
    //mostrar detalles
    public function show($id)
    {
        $companies = Company::all();
        $providers = Provider::all();
        $colors = Color::all();
        $product = Product::find($id);
        $subcategories = Subcategory::query()
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.id', 'subcategories.name', 'categories.name as categoryName')
            ->get();
        return view('products.show', compact('product', 'companies', 'providers', 'colors', 'subcategories'));
    }
    //editar
    public function edit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        $providers = Provider::all();
        $colors = Color::all();
        $subcategories = Subcategory::query()
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->select('subcategories.id', 'subcategories.name', 'categories.name as categoryName')
            ->get();

        return view('products.edit', compact('product', 'companies', 'providers', 'colors', 'subcategories'));
    }
    //editar status
    public function editStatus($id)
    {
        $product = Product::find($id);

        if ($product->status === 'active') {
            Product::find($id)->update(["status" => "inactive"]);
        } else {
            Product::find($id)->update(["status" => "active"]);
        }

        return redirect()->route('productos');
    }
    //actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        $image = $request->file('file');
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            //$fileName = time() . "_" . $image->getClientOriginalName(); 
            $fileName = "producto_"  . $id + 1 . '.' . $extension;

            $image->move(public_path('images'), $fileName);

            $request['photo'] = "images/" . $fileName;
        }

        session()->flash('success', 'Productos actualizado correctamente');

        Product::find($id)->update($request->all());
        return redirect()->route('productos')->with('message', session('success'));;
    }
}
