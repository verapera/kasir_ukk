@extends('home')
@section('content')
@section('title','Produk')
@if (auth()->user()->level=="Admin")
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  + Produk
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form tambah produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('addproduk') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col">
              <label for="" class="form-label">Kode produk</label>
              <input type="text" name="kode_produk" value="{{ old('kode_produk',\App\Models\Produk::kodeproduk()) }}" class="form-control" required>
          </div>
          <div class="col">
              <label for="" class="form-label">Nama produk</label>
              <input type="text" name="nama_produk" placeholder="Masukan nama produk..."  class="form-control" required>
          </div>
      </div>
      <div class="col">
          <label for="" class="form-label">Harga produk</label>
          <input type="number" name="harga" placeholder="Masukan harga produk..."  class="form-control" required>
      </div>
      <div class="col">
          <label for="" class="form-label">Stok produk</label>
          <input type="number" name="stok" placeholder="Masukan stok produk..."  class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>


<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal">
  <i class="ti ti-printer"></i> Laporan produk
 </button>
 
 <!-- Modal -->
 <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="modalLabel">Silahkan pilih status!</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form action="{{ route('reportproduk') }}" method="GET" target="_blank">
              <label for="" class="form-label">Status</label>
              <select name="status" id="" class="form-select">
                <option value="Ada">Ada</option>
                <option value="Habis">Habis</option>
              </select>
             <div class="modal-footer">
               <button type="submit" class="btn btn-danger">Print</button>
             </div>
            @csrf
         </form>
       </div>
     </div>
   </div>
 </div>

@endif

  <div class="card shadow">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
              <h5 class="fw-semibold">Data produk: </h5>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode produk</th>
                        <th>Nama produk</th>
                        <th>Harga produk</th>
                        <th>Stok produk</th>
                        @if (auth()->user()->level=="Admin")
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_produk }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>Rp.{{ number_format($item->harga) }}</td>
                            <td>{{ $item->stok }}</td>
                            @if (auth()->user()->level=="Admin")
                            <td>
                                <form  onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('deleteproduk',$item->produk_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="ti ti-trash"></i></button>
                                <a href="{{ route('showproduk',$item->produk_id) }}" class="btn btn-info"><i class="ti ti-pencil"></i></a>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data tidak tersedia
                        </div>
                    @endforelse
                    @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ (session('danger')) }}
                    </div>
                    @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ (session('success')) }}
                    </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection