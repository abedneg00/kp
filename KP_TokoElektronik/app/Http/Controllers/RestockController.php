<?php

namespace App\Http\Controllers;

use App\Models\ProductRestock;
use App\Models\Products;
use Illuminate\Http\Request;

class RestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $querybuilder = ProductRestock::with('products')->get(); // Mengambil data restock dengan relasi produk  
        return view('restock.index', ['data' => $querybuilder]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Products::all(); // Mengambil semua produk  
        return view('restock.create', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new ProductRestock();
        $data->quantity = $request->get('restock_quantity');
        $data->products_id = $request->get('restock_products_id');
        // dd($data);
        $data->save();
        
        return redirect()->route("restock.index")->with('status', "Produk berhasil di restock!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Temukan data berdasarkan ID  
            $deletedData = ProductRestock::with('products')->find($id); // Menggunakan 'products' sebagai nama relasi  

            // Pastikan data ditemukan sebelum melakukan delete  
            if ($deletedData) {
                // Tambahkan stok produk  
                $product = $deletedData->products; // Mengambil produk terkait  

                if ($product) { // Memastikan produk ditemukan  
                    $product->stok += $deletedData->quantity; // Menambah stok sesuai quantity  
                    $product->save();
                } else {
                    return redirect()->route('restock.index')->with('status', 'Failed to update stock, product not found.');
                }

                // Hapus data restock  
                $deletedData->delete();
                return redirect()->route('restock.index')->with('status', 'Restock selesai! stok produk telah bertambah!!');
            } else {
                return redirect()->route('restock.index')->with('status', 'Failed to delete data, restock not found.');
            }
        } catch (\PDOException $ex) {
            // Jika ada masalah pada penghapusan data  
            $msg = "Failed to delete data! Make sure there is no related data before deleting it.";
            return redirect()->route('restock.index')->with('status', $msg);
        }
    }


}
