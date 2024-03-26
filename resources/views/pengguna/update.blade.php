@extends('home')
@section('content')
@section('title','Update pengguna')
 <div class="card col-md-6 shadow">
    <div class="card-body">
        <form action="{{ route('updatepengguna',$pengguna->user_id) }}" method="POST">
            @csrf
            @method('PUT')
            <h5 class="fw-semibold">Form update pengguna: </h5>
            <div class="row">
                <div class="col">
                    <label for="" class="form-label">Name pengguna</label>
                    <input type="text" name="name"  value="{{ old('name',$pengguna->name) }}" class="form-control" required>
                </div>
                <div class="col">
                    <label for="" class="form-label">Username pengguna</label>
                    <input type="text" name="username"  value="{{ old('username',$pengguna->username) }}" class="form-control" required>
                </div>
           </div>
            <div class="col">
                <label for="" class="form-label">Password pengguna</label>
                <input type="password" name="password"  placeholder="Masukan password baru..."  class="form-control" required>
            </div>
            <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
 </div>
@endsection