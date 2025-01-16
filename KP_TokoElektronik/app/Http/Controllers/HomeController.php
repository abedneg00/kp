<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Products::all();
        $totalSales = Transactions::sum('total_price');
        $totalProductsSold = Transactions::sum('quantity_sold');

        // Debugging  
        // dd($products, $totalSales, $totalProductsSold);

        return view('welcome', compact('products', 'totalSales', 'totalProductsSold'));
    }
}
