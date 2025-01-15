@extends('layout.conquer')  
  
@section('content')  
<div class="container">  
    <h1>Tambah Produk</h1>  
  
    @if($errors->any())  
        <div class="alert alert-danger">  
            <ul>  
                @foreach($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        </div>  
    @endif  
  
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">  
        @csrf  
  
        <div class="mb-3">  
            <label for="product_name" class="form-label">Nama Produk</label>  
            <input type="text" class="form-control" id="product_name" name="product_name" required>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_desc" class="form-label">Deskripsi</label>  
            <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required></textarea>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_image" class="form-label">Gambar Produk</label>  
            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_price" class="form-label">Harga</label>  
            <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" required>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_stok" class="form-label">Stok</label>  
            <input type="number" class="form-control" id="product_stok" name="product_stok" required>  
        </div>  
  
        <button type="submit" class="btn btn-primary">Simpan Produk</button>  
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>  
    </form>  
</div>  
@endsection  
