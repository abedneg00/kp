@extends('layout.conquer')  
  
@section('content')  
<div class="container">  
    <h1>Edit Produk</h1>  
  
    @if($errors->any())  
        <div class="alert alert-danger">  
            <ul>  
                @foreach($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        </div>  
    @endif  
  
    <form action="{{ route('product.update', $data->id) }}" method="POST" enctype="multipart/form-data">  
        @csrf  
        @method('PUT')  
  
        <div class="mb-3">  
            <label for="product_name" class="form-label">Nama Produk</label>  
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $data->name }}" required>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_desc" class="form-label">Deskripsi</label>  
            <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required>{{ $data->desc }}</textarea>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_image" class="form-label">Gambar Produk (Kosongkan jika tidak ingin mengubah)</label>  
            <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">  
        </div>  
  
        <div class="mb-3">  
            <label for="product_price" class="form-label">Harga</label>  
            <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $data->price }}" step="0.01" required>  
        </div>  
  
        <div class="mb-3">  
            <label for="product_stok" class="form-label">Stok</label>  
            <input type="number" class="form-control" id="product_stok" name="product_stok" value="{{ $data->stok }}" required>  
        </div>  
  
        <button type="submit" class="btn btn-primary">Update Produk</button>  
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Kembali</a>  
    </form>  
</div>  
@endsection  
