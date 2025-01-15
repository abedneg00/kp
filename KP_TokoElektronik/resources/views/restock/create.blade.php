@extends('layout.conquer')  
  
@section('content')  
    <div class="container">  
        <h2 class="mb-4">Tambah Restock Produk</h2>  
  
        @if (session('status'))  
            <div class="alert alert-success">  
                {{ session('status') }}  
            </div>  
        @endif  
  
        <form action="{{ route('restock.store') }}" method="POST">  
            @csrf  
            <div class="form-group">  
                <label for="restock_products_id">Pilih Produk</label>  
                <select name="restock_products_id" id="restock_products_id" class="form-control" required>  
                    <option value="">-- Pilih Produk --</option>  
                    @foreach($products as $product)  
                        <option value="{{ $product->id }}">{{ $product->name }}</option>  
                    @endforeach  
                </select>  
            </div>  
  
            <div class="form-group">  
                <label for="restock_quantity">Jumlah Restock</label>  
                <input type="number" name="restock_guantity" id="restock_quantity" class="form-control" required>  
            </div>  
  
            <button type="submit" class="btn btn-primary">Simpan</button>  
            <a href="{{ route('restock.index') }}" class="btn btn-secondary">Kembali</a>  
        </form>  
    </div>  
@endsection  
