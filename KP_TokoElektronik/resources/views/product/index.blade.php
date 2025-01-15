@extends('layout.conquer')      
      
@section('content')      
<div class="container">      
    <h1>Daftar Produk</h1>      
      
    @if(session('status'))      
        <div class="alert alert-success">      
            {{ session('status') }}      
        </div>      
    @endif      
      
    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>      
      
    <div class="row">      
        @foreach($datas as $d)      
            <div class="col-md-4" id="tr_{{ $d->id }}">      
                <div class="card mb-4 box-shadow">      
                    <img class="card-img-top" src="{{ asset('images/' . $d->image) }}"      
                        alt="Thumbnail" style="height: 225px; width: 100%; display: block;">      
                          
                    <div class="card-body">      
                        <h5 class="card-title">{{ $d->name }}</h5>      
                        <p class="card-text">{{ $d->desc }}</p>      
  
                        <p><strong>Harga:</strong> Rp {{ number_format($d->price, 2, ',', '.') }}</p>  
                        <p><strong>Stok:</strong> {{ $d->stok }} unit</p>  
  
                        <div>      
                            @if (!empty($d->filenames))      
                                @foreach ($d->filenames as $filename)      
                                    <img src="{{ asset('product/' . $d->id . '/' . $filename) }}" style="height: 100px; width: auto;" /><br>      
                                    <form style="display: inline" method="POST" action="{{ url('product/delPhoto') }}">      
                                        @csrf      
                                        <input type="hidden" value="{{ 'product/' . $d->id . '/' . $filename }}" name='filepath' />      
                                        <input type="submit" value="Hapus" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">      
                                    </form>      
                                    <br>      
                                @endforeach      
                            @endif      
                        </div>      
  
                        <div class="mt-3">    
                            <a href="{{ route('product.edit', $d->id) }}" class="btn btn-warning btn-xs">Edit</a>    
                            <form style="display: inline" method="POST" action="{{ route('product.destroy', $d->id) }}">      
                                @csrf      
                                @method('DELETE')      
                                <input type="submit" value="Delete" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">      
                            </form>      
                        </div>      
                    </div>      
                </div>      
            </div>      
        @endforeach      
    </div>      
</div>      
@endsection      
