<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Detail;
use App\Models\Product;

class ReportsController extends Controller
{
    //listar Reportes
    public function index(Request $request)
    {

        return view('reports.index');
    }

    public function getReports(Request $request)
    {
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        $totalVentas = DB::table('details')
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', '=', 'active')
            ->whereDate('details.created_at', '>=', $fechaInicio)
            ->whereDate('details.created_at', '<=', $fechaFin)
            ->sum('details.price', '*', 'details.stock');

        $totalGrafica = Detail::query()
            ->select(DB::raw('date(details.created_at) as date'), DB::raw('SUM(details.price * details.stock) as total_price'))
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', '=', 'active')
            ->whereDate('details.created_at', '>=', $fechaInicio)
            ->whereDate('details.created_at', '<=', $fechaFin)
            ->groupBy('date')
            ->get();

        $totalVendidos = Product::query()
            ->leftJoin('details', 'details.product_id', '=', 'products.id')
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->select('products.id', 'products.photo', 'products.name', 'products.stock', 'products.reference', 'products.price', 'products.status', DB::raw('SUM(IF(details.stock,details.stock,0)) as stockDetail'))
            ->where('invoices.status', '=', 'active')
            ->whereDate('details.created_at', '>=', $fechaInicio)
            ->whereDate('details.created_at', '<=', $fechaFin)
            ->orderBy('stockDetail', 'desc')
            ->limit(5)
            ->groupBy('products.id', 'products.photo', 'products.name', 'products.stock', 'products.reference', 'products.price', 'products.status', 'details.product_id')->get();

        $totalProductos = DB::table('details')
            ->leftJoin('invoices', 'details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', '=', 'active')
            ->whereDate('details.created_at', '>=', $fechaInicio)
            ->whereDate('details.created_at', '<=', $fechaFin)
            ->sum('stock');


        return response()->json(['totalVentas' => $totalVentas, 'totalProductos' => $totalProductos, 'totalGrafica' => $totalGrafica, 'totalVendidos' => $totalVendidos]);
    }
}
