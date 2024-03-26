<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    //
    public function index(){
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index')->with(compact('pelanggan'));
    }
    public function addpelanggan(Request $request){
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan')->with('success','Data pelanggan berhasil ditambah!');
    }
    public function showpelanggan($pelanggan_id){
        $pelanggan= Pelanggan::findOrFail($pelanggan_id);
        return view('pelanggan.update')->with(compact('pelanggan'));
    }
    public function updatepelanggan( Request $request, $pelanggan_id){
        $pelanggan= Pelanggan::findOrFail($pelanggan_id);
        $pelanggan->update($request->all());
        return redirect()->route('pelanggan')->with('success','Data pelanggan berhasil diperbarui!');
    }
    public function deletepelanggan($pelanggan_id){
        $pelanggan= Pelanggan::findOrFail($pelanggan_id);
        $pelanggan->delete();
        return redirect()->route('pelanggan')->with('danager','Data pelanggan berhasil dihapus!');
    }
}
