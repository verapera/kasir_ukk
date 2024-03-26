@extends('home')
@section('content')
@section('title','Update produk')
 <div class="card col-md-6 shadow">
    <div class="card-body">
        <form action="{{ route('updateproduk',$produk->produk_id) }}" method="POST">
            @csrf
            @method('PUT')
            <h5 class="fw-semibold">Form update produk: </h5>
            <div class="row">
              <div class="col">
                  <label for="" class="form-label">Kode produk</label>
                  <input type="text" name="kode_produk" value="{{ old('kode_produk',$produk->kode_produk) }}" class="form-control" required>
              </div>
              <div class="col">
                  <label for="" class="form-label">Nama produk</label>
                  <input type="text" name="nama_produk" value="{{ old('nama_produk',$produk->nama_produk) }}" class="form-control" required>
              </div>
          </div>
          <div class="col">
              <label for="" class="form-label">Harga produk</label>
              <input type="number" name="harga" value="{{ old('harga',$produk->harga) }}"  class="form-control" required>
          </div>
          <div class="col">
              <label for="" class="form-label">Stok produk</label>
              <input type="number" name="stok" value="{{ old('stok',$produk->stok) }}"  class="form-control" required>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
    </div>
 </div>
@endsection