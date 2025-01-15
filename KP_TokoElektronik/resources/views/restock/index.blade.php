@extends('layout.conquer')

@section('content')
    <div class="container">
        <h2 class="mb-4">Daftar Restock Produk</h2>
        <br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ route('restock.create') }}" class="btn btn-primary mb-3">Restock Produk</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah Restock</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $restock)
                    <tr>
                        <td>{{ $restock->products->name }}</td> <!-- Menampilkan nama produk -->
                        <td>{{ $restock->quantity }}</td>
                        <td>
                            <form action="{{ route('restock.destroy', $restock->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-success">Selesaikan Restock</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data restock</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
