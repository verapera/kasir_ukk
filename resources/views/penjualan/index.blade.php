@extends('home')
@section('content')
@section('title','Penjualan')
@if (auth()->user()->level=="Kasir")
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Penjualan
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Silakan sesuaikan tanggal!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pelanggan</th>
                            <th>Alamat pelanggan</th>
                            <th>Nomor telepon</th>
                            <th>Pilih</th>
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
                                    <a href="{{ route('transaksi',$item->pelanggan_id) }}" class="btn btn-info"><i class="ti ti-pencil"></i></a>
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
    </div>
  </div>
@endif
@if (auth()->user()->level=="Admin")
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal">
    <i class="ti ti-printer"></i> Laporan penjualan
   </button>
   
   <!-- Modal -->
   <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="modalLabel">Form tambah produk</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <form action="{{ route('reportpenjualan') }}" method="GET" target="_blank">
             <div class="row">
               <div class="col">
                 <label for="" class="form-label">Dari</label>
                 <input type="date" name="dari" class="form-control">
               </div>
               <div class="col">
                 <label for="" class="form-label">Sampai</label>
                 <input type="date" name="sampai" class="form-control">
               </div>
               <div class="modal-footer">
                 <button type="submit" class="btn btn-danger">Print</button>
               </div>
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
            <h5 class="fw-semibold">Data penjualan hari ini: </h5>
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama pelanggan</th>
                          <th>Nota</th>
                          <th>Tanggal</th>
                          <th>Nominal</th>
                          <th>Cek</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($penjualan as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->pelanggans->nama_pelanggan }}</td>
                              <td>{{ $item->kode_penjualan }}</td>
                              <td>{{ $item->tanggal }}</td>
                              <td>Rp.{{ number_format($item->bayar) }}</td>
                              <td>
                                  <a href="{{ route('invoice',$item->kode_penjualan) }}" class="btn btn-info"><i class="ti ti-pencil"></i></a>
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