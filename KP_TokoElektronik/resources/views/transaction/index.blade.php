@extends('layout.conquer')  
  
@section('content')  
<div class="container">  
    <h1>Daftar Transaksi</h1>  
  
    @if(session('status'))  
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
                <th>Nama Produk</th>  
                <th>Jumlah Terjual</th>  
                <th>Metode Pembayaran</th>  
                <th>Total Harga</th>  
                <th>Admin</th>  
                <th>Aksi</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($data as $transaction)  
                <tr>  
                    <td>{{ $transaction->id }}</td>  
                    <td>{{ $transaction->no_penjualan }}</td>  
                    <td>{{ $transaction->transaction_date }}</td>  
                    <td>{{ $transaction->product->name }}</td> <!-- Menampilkan nama produk -->  
                    <td>{{ $transaction->quantity_sold }}</td>  
                    <td>{{ $transaction->payment_method }}</td>  
                    <td>Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</td>  
                    <td>{{ $transaction->user->name }}</td> <!-- Menampilkan nama pengguna -->  
                    <td>  
                        <form method="POST" action="{{ route('transaction.destroy', $transaction->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-danger"
                                onclick="return confirm('Are you sure to delete {{ $transaction->id }} - {{ $transaction->no_penjualan }} ? ');">
                        </form>
                    </td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>  
@endsection  
