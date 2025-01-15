<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Pastikan ini ditambahkan di bagian atas  

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $rs = Products::all();
        foreach ($rs as $r) {
            $directory = public_path('product/' . $r->id);
            if (File::exists($directory)) {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $r['filenames'] = $filenames;
            }
        }
        return view('product.index', ['datas' => $rs]);
    }

    public function simpanPhoto(Request $request)
    {
        $file = $request->file("file_photo");
        $folder = 'product/' . $request->product_id;
        File::makeDirectory(public_path($folder), 0755, true, true);
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move($folder, $filename);
        return redirect()->route('product.index')->with('status', 'Photo terupload');
    }

    public function delPhoto(Request $request)
    {
        File::delete(public_path($request->filepath));
        return redirect()->route('product.index')->with('status', 'Photo dihapus');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|numeric',
            'product_stok' => 'required|integer',
        ]);

        // Menyimpan gambar  
        $file = $request->file('product_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        // Menyimpan produk  
        $data = new Products();
        $data->name = $request->get('product_name');
        $data->desc = $request->get('product_desc');
        $data->image = $filename; // Simpan nama file gambar  
        $data->price = $request->get('product_price');
        $data->stok = $request->get('product_stok');

        $data->save();

        return redirect()->route('product.index')->with('status', 'Produk berhasil ditambahkan!');
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
        $data = Products::find($id);

        return view("product.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatedData = Products::find($id);

        // Pastikan data ditemukan sebelum melakukan update  
        if ($updatedData) {
            $updatedData->name = $request->product_name;
            $updatedData->desc = $request->product_desc;

            // Cek apakah ada gambar baru yang diunggah  
            if ($request->hasFile('product_image')) {
                // Hapus gambar lama jika ada  
                if ($updatedData->image) {
                    $oldImagePath = public_path('images/' . $updatedData->image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                // Simpan gambar baru  
                $file = $request->file('product_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $updatedData->image = $filename; // Simpan nama file gambar baru  
            }

            $updatedData->price = $request->product_price;
            $updatedData->stok = $request->product_stok;
            $updatedData->save();

            return redirect()->route("product.index")->with('status', "Data produk anda telah berhasil diubah!");
        } else {
            return redirect()->route("product.index")->with('status', "Gagal mengubah data. Produk tidak ditemukan!");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        try {
            //if no contraint error, then delete data. Redirect to index after it.
            $deletedData = $product;
            $deletedData->delete();
            return redirect()->route('product.index')->with('status', 'Data produk telah berhasil dihapus!');
        } catch (\PDOException $ex) {
            // Failed to delete data, then show exception message
            $msg = "Gagal menghapus data !";
            return redirect()->route('product.index')->with('status', $msg);
        }
    }
}
