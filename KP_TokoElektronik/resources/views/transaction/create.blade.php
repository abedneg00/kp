@extends('layout.conquer')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">TRANSAKSI PENJUALAN</h1>

        <h3>DATA TRANSAKSI</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="no_penjualan" class="form-label">No Penjualan</label>
                <input type="text" class="form-control" id="no_penjualan" name="no_penjualan" value="{{ $noPenjualan }}"
                    readonly>
            </div>
            <br>
            <div class="mb-3">
                <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                <input type="datetime-local" class="form-control" id="transaction_date" name="transaction_date" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="products_id" class="form-label">Pilih Produk</label>
                <select class="form-select" id="products_id" name="products_id" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="quantity_sold" class="form-label">Jumlah Terjual</label>
                <input type="number" class="form-control" id="quantity_sold" name="quantity_sold" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Harga</label>
                <input type="text" class="form-control" id="total_price" name="total_price" readonly>
            </div>
            <br>
            
            <div class="mb-3">
                <label for="users_id" class="form-label">Kasir Admin</label>
                <p class="form-control-plaintext">{{ Auth::user()->name }}</p>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        document.getElementById('quantity_sold').addEventListener('input', function() {
            const quantity = this.value;
            const productId = document.getElementById('products_id').value;

            if (productId) {
                fetch(`/api/products/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        const price = data.price;
                        const totalPrice = quantity * price;
                        document.getElementById('total_price').value = totalPrice.toFixed(2);
                    });
            }
        });

        document.getElementById('products_id').addEventListener('change', function() {
            const quantity = document.getElementById('quantity_sold').value;
            const productId = this.value;

            if (productId) {
                fetch(`/api/products/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        const price = data.price;
                        const totalPrice = quantity * price;
                        document.getElementById('total_price').value = totalPrice.toFixed(2);
                    });
            }
        });
    </script>
@endsection
