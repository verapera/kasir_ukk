@extends('home')
@section('content')
@section('title','Update pelanggan')
 <div class="card col-md-6 shadow">
    <div class="card-body">
        <form action="{{ route('updatepelanggan',$pelanggan->pelanggan_id) }}" method="POST">
            @csrf
            @method('PUT')
            <h5 class="fw-semibold">Form update pelanggan: </h5>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Nama pelanggan</label>
                    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan',$pelanggan->nama_pelanggan) }}"  class="form-control" required>
                </div>
                <div class="col">
                    <label for="" class="form-label">Alamat pelanggan</label>
                    <input type="text" name="alamat"value="{{ old('alamat',$pelanggan->alamat) }}"  class="form-control" required>
                </div>
            </div>
            <div class="col">
                <label for="" class="form-label">Nomor telepon pelanggan</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon',$pelanggan->nomor_telepon) }}"  class="form-control" required>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
 </div>
@endsection