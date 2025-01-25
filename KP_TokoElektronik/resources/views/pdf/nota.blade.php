<!DOCTYPE html>  
<html>  
  
<head>  
    <title>Nota Transaksi</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
        }  
  
        .header {  
            text-align: center;  
            margin-bottom: 20px;  
        }  
  
        .table {  
            width: 100%;  
            border-collapse: collapse;  
        }  
  
        .table,  
        .table th,  
        .table td {  
            border: 1px solid black;  
        }  
  
        .table th,  
        .table td {  
            padding: 8px;  
            text-align: left;  
        }  
    </style>  
</head>  
  
<body>  
  
    <div class="header">  
        <h1>Nota Transaksi</h1>  
        <p>TOKO AMIN ELEKTRONIK</p>
        <p>Jl. Ketapang - Sukadana RT.016/RW.008</p>
        <p>ID Transaksi: {{ $transaction->id }}</p>  
        <p>Tanggal: {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y H:i') }}</p>  
        <p>Nama User: {{ optional($transaction->user)->name }}</p> <!-- Display user name -->  
    </div>  
  
    <h3>Detail Transaksi</h3>  
    <table class="table">  
        <thead>  
            <tr>  
                <th>Nama Produk</th>  
                <th>Jumlah</th>  
                <th>Harga</th>  
                <th>Total</th>  
            </tr>  
        </thead>  
        <tbody>  
            <tr>  
                <td>{{ $transaction->product->name }}</td>  
                <td>{{ $transaction->quantity_sold }}</td>  
                <td>Rp {{ number_format($transaction->total_price / $transaction->quantity_sold, 2, ',', '.') }}</td>  
                <td>Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</td>  
            </tr>  
        </tbody>  
    </table>  
  
    <h3>Total: Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</h3>  
  
</body>  
  
</html>  
