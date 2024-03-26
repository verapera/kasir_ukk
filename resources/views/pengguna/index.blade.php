@extends('home')
@section('content')
@section('title','Pengguna')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Pengguna
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form tambah pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('addpengguna') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col">
                <label for="" class="form-label">Name pengguna</label>
                <input type="text" name="name" placeholder="Masukan name pengguna..."  class="form-control" required>
            </div>
            <div class="col">
                <label for="" class="form-label">Username pengguna</label>
                <input type="text" name="username" placeholder="Masukan username pengguna..."  class="form-control" required>
            </div>
        </div>
        <div class="col">
            <label for="" class="form-label">Password pengguna</label>
            <input type="password" name="password" placeholder="Masukan password pengguna..."  class="form-control" required>
        </div>
        <div class="col">
            <label for="" class="form-label">Level</label>
            <select name="level" id="" class="form-select">
                <option value="Admin">Admin</option>
                <option value="Kasir">Kasir</option>
            </select>
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
          <h5 class="fw-semibold">Data pengguna: </h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name pengguna</th>
                        <th>Username pengguna</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($pengguna as $item)
                    {{-- @dd($item->user_id) --}}
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->level }}</td>
                        <td>
                            <form  onsubmit="return confirm('Yakin ingin menghapus data ini?')" action="{{ route('deletepengguna',$item->user_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="ti ti-trash"></i></button>
                            <a href="{{ route('showpengguna',$item->user_id) }}" class="btn btn-info"><i class="ti ti-pencil"></i></a>
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