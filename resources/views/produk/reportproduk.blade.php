<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan produk</title>
</head>
<body>
    <center>
        <br>
        <h3>Laporan produk "{{ $status }} "</h3>
        <table class="table table-striped" cellspacing="0"; cellpadding="20" border="1">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Kode produk</th>
                      <th>Nama produk</th>
                      <th>Harga produk</th>
                      <th>Stok produk</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($produk as $item)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->kode_produk }}</td>
                          <td>{{ $item->nama_produk }}</td>
                          <td>{{ $item->harga }}</td>
                          <td>{{ $item->stok }}</td>
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
    </center>
    <script>
        window.print();
    </script>
</body>
</html>