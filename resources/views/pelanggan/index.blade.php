@extends('home')
@section('content')
@section('title','Pelanggan')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Pelanggan
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form tambah pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('addpelanggan') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col">
                <label for="" class="form-label">Nama pelanggan</label>
                <input type="text" name="nama_pelanggan" placeholder="Masukan nama pelanggan..."  class="form-control" required>
            </div>
            <div class="col">
                <label for="" class="form-label">Alamat pelanggan</label>
                <input type="text" name="alamat" placeholder="Masukan alamat pelanggan..."  class="form-control" required>
            </div>
        </div>
        <div class="col">
            <label for="" class="form-label">Nomor telepon pelanggan</label>
            <input type="text" name="nomor_telepon" placeholder="Masukan nomor telepon pelanggan..."  class="form-control" required>
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

  <div class="card shadow">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
          <h5 class="fw-semibold">Data pelanggan: </h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama pelanggan</th>
                        <th>Alamat pelanggan</th>
                        <th>Nomor telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            <td>
                                <form  onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('deletepelanggan',$item->pelanggan_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="ti ti-trash"></i></button>
                                <a href="{{ route('showpelanggan',$item->pelanggan_id) }}" class="btn btn-info"><i class="ti ti-pencil"></i></a>
                                </form>
                            </td>
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