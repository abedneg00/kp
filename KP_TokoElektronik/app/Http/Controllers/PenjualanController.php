<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\ProductRestock; // Tambahkan model ProductRestock  
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**  
     * Display a listing of the resource.  
     */

    public function index()
    {
        try {
            // Eager load the product relationship  
            $transactions = Transactions::with('product')->get();

            // Check if transactions are empty  
            if ($transactions->isEmpty()) {
                return view('transaction.index', ['data' => [], 'message' => 'No transactions found.']);
            }

            return view('transaction.index', ['data' => $transactions]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur  
            return redirect()->route('transaction.index')->with('status', 'Error fetching transactions: ' . $e->getMessage());
        }
    }
    /**  
     * Show the form for creating a new resource.  
     */
    public function create()
    {
        $products = Products::all();
        $users = Users::all();

        // Menghitung ID penjualan berikutnya    
        $nextId = Transactions::count() + 1; // Menghitung jumlah transaksi untuk ID berikutnya    
        $noPenjualan = 'P' . str_pad($nextId, 8, '0', STR_PAD_LEFT); // Format No Penjualan    

        return view('transaction.create', compact('products', 'users', 'noPenjualan'));
    }

    /**  
     * Store a newly created resource in storage.  
     */
    public function store(Request $request)
    {
        $data = new Transactions();
        $data->no_penjualan = $request->get('no_penjualan');
        $data->transaction_date = $request->get('transaction_date');
        $data->products_id = $request->get('products_id');
        $data->quantity_sold = $request->get('quantity_sold');
        $data->payment_method = $request->get('payment_method');
        $data->total_price = $request->get('total_price');
        $data->users_id = $request->get('users_id');

        $data->save();

        return redirect()->route("transaction.index")->with('status', "Selamat!! data transaksi anda telah tersimpan ke database!");
    }

    /**  
     * Display the specified resource.  
     */
    public function show(string $id)
    {
        // Implementasi untuk menampilkan detail transaksi jika diperlukan  
    }

    /**  
     * Show the form for editing the specified resource.  
     */
    public function edit(string $id)
    {
        $data = Transactions::find($id);
        return view("transaction.edit", compact('data'));
    }

    /**  
     * Update the specified resource in storage.  
     */
    public function update(Request $request, string $id)
    {
        // Implementasi untuk memperbarui transaksi jika diperlukan  
    }

    /**  
     * Remove the specified resource from storage.  
     */
    public function destroy(string $id)
    {
        try {
            // Temukan data berdasarkan ID  
            $deletedData = Transactions::find($id);

            // Pastikan data ditemukan sebelum melakukan delete  
            if ($deletedData) {
                $deletedData->delete();
                return redirect()->route('transaction.index')->with('status', 'Data produk telah berhasil dihapus!');
            } else {
                return redirect()->route('transaction.index')->with('status', 'Failed to delete data, warehouse not found.');
            }
        } catch (\PDOException $ex) {
            // Jika ada masalah pada penghapusan data  
            $msg = "Failed to delete data! Make sure there is no related data before deleting it.";
            return redirect()->route('transaction.index')->with('status', $msg);
        }
    }


    public function report(Request $request)
    {
        // Get filter parameters
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $product_id = $request->get('product_id');
        $payment_method = $request->get('payment_method');

        // Base queries
        $soldProductsQuery = Transactions::select('products_id')
            ->selectRaw('SUM(quantity_sold) as total_sold')
            ->selectRaw('SUM(total_price) as total_revenue')
            ->groupBy('products_id')
            ->with('product');

        $restockProductsQuery = ProductRestock::select('products_id', 'quantity')
            ->with('products');

        $currentStockQuery = Products::select('id', 'name', 'stok');

        // Apply filters
        if ($start_date && $end_date) {
            $soldProductsQuery->whereBetween('transaction_date', [$start_date, $end_date]);
        }

        if ($product_id) {
            $soldProductsQuery->where('products_id', $product_id);
            $restockProductsQuery->where('products_id', $product_id);
            $currentStockQuery->where('id', $product_id);
        }

        if ($payment_method) {
            $soldProductsQuery->where('payment_method', $payment_method);
        }

        // Get the filtered results
        $soldProducts = $soldProductsQuery->get();
        $restockProducts = $restockProductsQuery->get();
        $currentStock = $currentStockQuery->get();

        // Get data for filter dropdowns
        $allProducts = Products::select('id', 'name')->get();
        $paymentMethods = Transactions::select('payment_method')
            ->distinct()
            ->pluck('payment_method');

        return view('transaction.report', compact(
            'soldProducts',
            'restockProducts',
            'currentStock',
            'allProducts',
            'paymentMethods',
            'start_date',
            'end_date',
            'product_id',
            'payment_method'
        ));
    }

    public function printNota($id)  
    {  
        // Fetch the transaction data  
        $transaction = Transactions::with('product', 'user')->findOrFail($id); // Eager load the product relationship  
   
        // Create a PDF instance and load the view  
        $pdf = PDF::loadView('pdf.nota', compact('transaction')); // Pass the transaction variable  
   
        // Return the PDF as a download  
        return $pdf->download('nota_' . $transaction->no_penjualan . '.pdf');  
    }  
 



}
