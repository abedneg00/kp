@extends('layout.conquer')

@section('content')
    <div class="container">
        <h2 class="mb-4">Laporan Penjualan</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Filter Laporan</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('laporan.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ $start_date ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ $end_date ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="product_id" class="form-label">Produk</label>
                        <select class="form-select" id="product_id" name="product_id">
                            <option value="">Semua Produk</option>
                            @foreach ($allProducts as $product)
                                <option value="{{ $product->id }}"
                                    {{ (string) $product->id === (string) ($product_id ?? '') ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment_method" name="payment_method">
                            <option value="">Semua Metode</option>
                            @foreach ($paymentMethods as $method)
                                <option value="{{ $method }}"
                                    {{ $method === ($payment_method ?? '') ? 'selected' : '' }}>
                                    {{ ucfirst($method) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Produk Terjual -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Produk Terjual</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Total Terjual</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soldProducts as $product)
                            <tr>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->total_sold }}</td>
                                <td>Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data penjualan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Produk Dalam Proses Restock -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Produk Dalam Proses Restock</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Restock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($restockProducts as $restock)
                            <tr>
                                <td>{{ $restock->products->name }}</td>
                                <td>{{ $restock->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada produk dalam proses restock</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stok Tersedia -->
        <div class="card">
            <div class="card-header">
                <h4>Stok Tersedia</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Stok Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($currentStock as $stock)
                            <tr>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->stok }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada data stok</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-submit form when select fields change
            document.querySelectorAll('select').forEach(select => {
                select.addEventListener('change', () => {
                    document.querySelector('form').submit();
                });
            });
        </script>
    @endpush
@endsection
