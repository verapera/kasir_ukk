@extends('home')
@section('content')
@section('title','Penjualan')
<!-- Button trigger modal -->
<div class="row">
    <div class="card shadow col-md-4">
        <div class="card-body">
            <form action="{{ route('addtemp',$pelanggan->pelanggan_id) }}" method="POST">
                @csrf
                <h5 class="fw-semibold">Silakan pilih produk! </h5>
                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->pelanggan_id }}">
                    <div class="col">
                        <label for="" class="form-label">Nama pelanggan</label>
                        <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Pilih produk</label>
                        <select name="produk_id" id="" class="form-select">
                            @foreach ($produk as $item)
                                <option value="{{ $item->produk_id }}">{{ $item->nama_produk }} - Rp.{{  $item->harga  }} ({{  $item->stok  }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Jumlah produk</label>
                        <input type="number" name="jumlah" placeholder="Masukan jumlah produk..."  class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">+ Keranjang</button>
                    </div>
                </form>
        </div>
    </div>
    <div class="card shadow col-md-8">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <h5 class="fw-semibold">Data keranjang: </h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode produk</th>
                            <th>Nama produk</th>
                            <th>Quantity </th>
                            <th>Harga </th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total=0; $cek=0; $items=0; ?>
                        @forelse ($temp as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_produk }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->jumlah }}
                                    <?php
                                       if($item->stok < $item->jumlah){
                                        echo " <span class='badge bg-danger'>Stok tidak mencukupi</span>";
                                       }
                                    ?>
                                </td>
                                <td>Rp.{{ number_format($item->harga) }}</td>
                                <td>Rp.{{ number_format($item->harga*$item->jumlah) }}</td>
                                <td>
                                    <form  onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('deletetemp',$item->temp_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $total+=$item->harga*$item->jumlah?>
                            <?php $items+=$item->jumlah?>
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
                        <tr>
                            <td colspan="5">Total tagihan</td>
                            <td colspan="5">Rp.{{ number_format($total) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">Total items</td>
                            <td colspan="5">{{ $items }}</td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{ route('bayar',$pelanggan_id) }}" method="POST">
                    @csrf
                    @if ($cek==0 && $temp->count()!==0)
                    <div class="col-md-5">
                        <label for="" class="form-label">Pembayaran</label>
                        <input type="number" name="bayar" placeholder="Masukan nominal..." class="form-control" required>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                        <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->pelanggan_id }}">
                        <input type="hidden" name="total_harga" value="{{ $total }}">
                        <button class="btn btn-danger mt-3" type="submit">Bayar</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
      </div>
</div>

 
@endsection