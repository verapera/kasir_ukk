<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan penjualan</title>
</head>
<body>
   <center>
    <br>
    <h3>Laporan penjualan {{ $dari }} s/d {{ $sampai }}</h3>
    
    <table class="table table-striped" border="1" cellspacing="0"; cellpadding="20">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama pelanggan</th>
                <th>Nota</th>
                <th>Tanggal</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0;?>
            @forelse ($penjualan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pelanggans->nama_pelanggan }}</td>
                    <td>{{ $item->kode_penjualan }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>Rp. {{ number_format( $item->bayar )}}</td>
                </tr>
                <?php $total+=$item->bayar?>
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
                <td colspan="4">Total</td>
                <td>Rp. {{ number_format($total )}}</td>
            </tr>
        </tbody>
    </table>
    </center> 
    <script>
        window.print();
    </script>
</body>
</html>