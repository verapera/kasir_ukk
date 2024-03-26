@extends('home')
@section('content')
@section('title','Invoice')
    <div class="card shadow">
        <div class="card-body">
            <h5 class="fw-semibold">Invoice | {{ $penjualan->tanggal }} </h5> <br>
            <div class="row">
                <div class="col-md-4">
                    <span class="fw-semibold">
                        From :
                    </span>
                    <p>
                        Metronic Toserba <br>
                        {{$users->level }} : {{$users->username }} <br>
                        Jl. Derpoyudho, KM 05, Mojogedang <br>
                        Hp. 089672284196
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fw-semibold">
                        To :
                    </span>
                    <p>
                        {{$penjualan->nama_pelanggan }} <br> 
                        {{$penjualan->alamat }} <br> 
                        Hp. {{$penjualan->nomor_telepon }} <br> 
                    </p>
                </div>
                <div class="col-md-4">
                    <h3 class="fw-semibold">#{{ $nota }}</h3>
                </div>
            </div>
            <br>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode produk</th>
                            <th>Nama produk</th>
                            <th>Quantity </th>
                            <th>Harga </th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total=0; $cek=0; $items=0; ?>
                        @forelse ($detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_produk }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->jumlah }}
                                </td>
                                <td>Rp.{{ number_format($item->harga) }}</td>
                                <td>Rp.{{ number_format($item->harga*$item->jumlah) }}</td>
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
                            <td colspan="5">Pembayaran</td>
                            <td colspan="5">Rp.{{ number_format($penjualan->bayar) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">Total tagihan</td>
                            <td colspan="5">Rp.{{ number_format($total) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">Total items</td>
                            <td colspan="5">{{ $items }}</td>
                        </tr>
                        <tr>
                            <td colspan="5">Kembalian</td>
                            <td colspan="5">Rp.{{ number_format($penjualan->bayar-$total) }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('struk',$nota) }}" class="btn btn-danger" target="_blank"><i class="ti ti-printer"></i> Print</a>
            </div>

        </div>
    </div>

@endsection