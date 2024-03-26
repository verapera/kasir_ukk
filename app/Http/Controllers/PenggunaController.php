<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    //
    public function index(){
        $pengguna = User::all();
        return view('pengguna.index')->with(compact('pengguna'));
    }
    public function addpengguna(Request $request){
        User::create($request->all());
        return redirect()->route('pengguna')->with('success','Data pengguna berhasil ditambah!');
    }
    public function showpengguna($user_id){
        $pengguna= User::findOrFail($user_id);
        return view('pengguna.update')->with(compact('pengguna'));
    }
    public function updatepengguna( Request $request, $user_id){
        $pengguna= User::findOrFail($user_id);
        $pengguna->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt( $request->password),
        ]);
        return redirect()->route('pengguna')->with('success','Data pengguna berhasil diperbarui!');
    }
    public function deletepengguna($user_id){
        $pengguna= User::findOrFail($user_id);
        $pengguna->delete();
        return redirect()->route('pengguna')->with('danager','Data pengguna berhasil dihapus!');
    }
}
