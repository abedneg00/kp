@extends('layout.conquer')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Transaksi</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No Penjualan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Produk</th>
                    <th>Jumlah Terjual</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->no_penjualan }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}</td> <!-- Format the date -->  
                        <td>{{ $transaction->product->name }}</td> <!-- Assuming you have a relationship defined -->
                        <td>{{ $transaction->quantity_sold }}</td>
                        <td>{{ ucfirst($transaction->payment_method) }}</td>
                        <td>{{ number_format($transaction->total_price, 2) }}</td>
                        <td>
                            <a href="{{ route('transaction.print', $transaction->id) }}" class="btn btn-info btn-sm">Print
                                Nota</a>
                            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this transaction?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
