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
                <label for="product_search">Pilih Produk</label>    
                <input type="text" id="product_search" class="form-control" placeholder="Cari produk..." required>  
                <input type="hidden" id="selected_product_id" name="restock_products_id">  
                <div id="product_list" class="list-group"></div>  
            </div>    
    
            <div class="form-group">    
                <label for="restock_quantity">Jumlah Restock</label>    
                <input type="number" name="restock_quantity" id="restock_quantity" class="form-control" required>    
            </div>    
    
            <button type="submit" class="btn btn-primary">Simpan</button>    
            <a href="{{ route('restock.index') }}" class="btn btn-secondary">Kembali</a>    
        </form>    
    </div>    
  
    <script>  
        const products = @json($products);  
        const productSearch = document.getElementById('product_search');  
        const productList = document.getElementById('product_list');  
        const selectedProductId = document.getElementById('selected_product_id');  
  
        productSearch.addEventListener('input', function() {  
            const query = productSearch.value.toLowerCase();  
            productList.innerHTML = '';  
  
            if (query.length > 0) {  
                const filteredProducts = products.filter(product => product.name.toLowerCase().includes(query));  
                filteredProducts.forEach(product => {  
                    const productItem = document.createElement('a');  
                    productItem.href = '#';  
                    productItem.className = 'list-group-item list-group-item-action';  
                    productItem.textContent = product.name;  
                    productItem.addEventListener('click', function(event) {  
                        event.preventDefault();  
                        productSearch.value = product.name;  
                        selectedProductId.value = product.id;  
                        productList.innerHTML = '';  
                    });  
                    productList.appendChild(productItem);  
                });  
            }  
        });  
    </script>  
@endsection    