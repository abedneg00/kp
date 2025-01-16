@extends('layout.conquer')

@section('content')
    <div class="container">
        <h1 class="mt-4">Selamat Datang di TOKO AMIN ELEKTRONIK</h1>
        <p>Halaman ini menampilkan informasi singkat mengenai ringkasan penjualan, jumlah stok produk, harga produk, dan
            nama produk.</p>

        <div class="row">
            <div class="col-md-6">
                <h2>Ringkasan Produk</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stok }}</td>
                                <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h2>Ringkasan Penjualan</h2>
                <p>Total Penjualan: Rp {{ number_format($totalSales, 2, ',', '.') }}</p>
                <p>Total Produk Terjual: {{ $totalProductsSold }}</p>
            </div>
        </div>
    </div>
@endsection
