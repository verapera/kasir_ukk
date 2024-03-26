<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk | {{ $nota }}</title>
</head>
<body>
    <br>
    ========================================== <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Metronic Toserba <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jl. Derpoyudho, KM 05, Mojogedang <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hp. 089672284196 <br>
    ========================================== <br>
    {{ $penjualan->tanggal }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#{{ $penjualan->kode_penjualan }} <br>
    {{$users->level }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$users->username }} <br>
    Pelanggan : {{ $penjualan->nama_pelanggan }} <br>
    ----------------------------------------------------------------------- <br>
    <table class="table table-bordered" cellpadding="11">
        <thead>
            <tr>
                <td>No</td>
                <td>Kd Brg</td>
                <td>Qty </td>
                <td>Harga </td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php $total=0; $cek=0; $items=0; ?>
            @forelse ($detail as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_produk }}</td>
                    <td>{{ $item->jumlah }}   </td>
                    <td>Rp.{{ number_format($item->harga) }}</td>
                    <td>Rp.{{ number_format($item->harga*$item->jumlah) }}</td>
                </tr>
                <?php $total+=$item->harga*$item->jumlah?>
                <?php $items+=$item->jumlah?>
                <tr>
                    <td>Brg</td>
                    <td>{{ $item->nama_produk }}</td>
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
    ----------------------------------------------------------------------- <br>
    <table>
        <tr>
            <td colspan="5">Pembayaran &nbsp;:</td>
            <td colspan="5">Rp.{{ number_format($penjualan->bayar) }}</td>
        </tr>
        <tr>
            <td colspan="5">Total tagihan :</td>
            <td colspan="5">Rp.{{ number_format($total) }}</td>
        </tr>
        <tr>
            <td colspan="5">Total items&nbsp;&nbsp;&nbsp; :</td>
            <td colspan="5">{{ $items }}</td>
        </tr>
        <tr>
            <td colspan="5">Kembalian &nbsp;&nbsp;&nbsp;:</td>
            <td colspan="5">Rp.{{ number_format($penjualan->bayar-$total) }}</td>
        </tr>
    </table>
    <br>
    ===============TERIMAKASIH=============== <br>
    <script>
        window.print();
    </script>
</body>
</html>