<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        $data['sales'] = Sale::all();
        return view('coffee_sales', ['data' => $data]);
    }
    public function addsale(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required',
            'up' => 'required',
            'sp' => 'required'
        ]);
        try {
            $sale = new Sale();
            $sale->product_id = $request->product;
            $sale->quantity = $request->quantity;
            $sale->cost = $request->up;
            $sale->sellingprice = $request->sp;
            $sale->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect('/sales');
    }
}
