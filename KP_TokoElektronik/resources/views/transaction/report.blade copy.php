@extends('layout.conquer')

@section('content')
    <div class="container">
        <h2 class="mb-4">Laporan Penjualan</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form (tetap sama seperti sebelumnya) -->

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
                            <th>Metode Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soldProducts as $product)
                            <tr id="sale-row-{{ $product->products_id }}">
                                <td>{{ $product->product->name }}</td>
                                <td class="editable-cell">
                                    <span class="display-value">{{ $product->total_sold }}</span>
                                    <form action="{{ route('transaction.updateSales', ['id' => $product->products_id]) }}"
                                        method="POST" class="edit-form d-none">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity_sold" value="{{ $product->total_sold }}"
                                            class="form-control">
                                        <input type="hidden" name="products_id" value="{{ $product->products_id }}">
                                </td>
                                <td class="editable-cell">
                                    <span class="display-value">Rp
                                        {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                                    <input type="number" name="total_price" value="{{ $product->total_revenue }}"
                                        class="form-control d-none">
                                </td>
                                <td class="editable-cell">
                                    <span class="display-value">{{ $product->payment_method }}</span>
                                    <select name="payment_method" class="form-control d-none">
                                        <option value="cash" {{ $product->payment_method == 'cash' ? 'selected' : '' }}>
                                            Cash</option>
                                        <option value="credit"
                                            {{ $product->payment_method == 'credit' ? 'selected' : '' }}>Credit
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-success save-btn d-none">Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn d-none">Batal</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data penjualan</td>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($restockProducts as $restock)
                            {{-- {{ dd($restock) }} // Temporary debug line --}}

                            <tr id="restock-row-{{ $restock->id }}">
                                <td>{{ $restock->products->name }}</td>
                                <td class="editable-cell">
                                    <span class="display-value">{{ $restock->quantity }}</span>
                                    <form action="{{ route('transaction.updateRestock', ['id' => $restock['id']]) }}"
                                        method="POST" class="edit-form d-none">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $restock->quantity }}"
                                            class="form-control">
                                        <input type="hidden" name="restock_id" value="{{ $restock->id }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary edit-btn">Edit</button>
                                    <button type="submit" class="btn btn-sm btn-success save-btn d-none">Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn d-none">Batal</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada produk dalam proses restock</td>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($currentStock as $stock)
                            <tr id="stock-row-{{ $stock->id }}">
                                <td>{{ $stock->name }}</td>
                                <td class="editable-cell">
                                    <span class="display-value">{{ $stock->stok }}</span>
                                    <form action="{{ route('transaction.updateStock', ['id' => $stock->id]) }}"
                                        method="POST" class="edit-form d-none">

                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="stok" value="{{ $stock->stok }}"
                                            class="form-control">
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary edit-btn">Edit</button>
                                    <button type="submit" class="btn btn-sm btn-success save-btn d-none">Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn d-none">Batal</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data stok</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle edit button clicks
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const row = this.closest('tr');

                        // Hide display values and show edit forms
                        row.querySelectorAll('.display-value').forEach(span => {
                            span.classList.add('d-none');
                        });
                        row.querySelectorAll('.edit-form').forEach(form => {
                            form.classList.remove('d-none');
                        });

                        // Show/hide buttons
                        row.querySelector('.edit-btn').classList.add('d-none');
                        row.querySelector('.save-btn').classList.remove('d-none');
                        row.querySelector('.cancel-btn').classList.remove('d-none');
                    });
                });

                // Handle cancel button clicks
                document.querySelectorAll('.cancel-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const row = this.closest('tr');

                        // Show display values and hide edit forms
                        row.querySelectorAll('.display-value').forEach(span => {
                            span.classList.remove('d-none');
                        });
                        row.querySelectorAll('.edit-form').forEach(form => {
                            form.classList.add('d-none');
                        });

                        // Show/hide buttons
                        row.querySelector('.edit-btn').classList.remove('d-none');
                        row.querySelector('.save-btn').classList.add('d-none');
                        row.querySelector('.cancel-btn').classList.add('d-none');
                    });
                });
            });
        </script>
    @endpush

    <style>
        .editable-cell {
            position: relative;
        }

        .edit-form {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 5px;
        }
    </style>
@endsection
