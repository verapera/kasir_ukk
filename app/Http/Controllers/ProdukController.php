<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //
    public function index(){
        $produk = Produk::all();
        return view('produk.index')->with(compact('produk'));
    }
    public function addproduk(Request $request){
        Produk::create($request->all());
        return redirect()->route('produk')->with('success','Data produk berhasil ditambah!');
    }
    public function showproduk($produk_id){
        $produk= Produk::findOrFail($produk_id);
        return view('produk.update')->with(compact('produk'));
    }
    public function updateproduk( Request $request, $produk_id){
        $produk= Produk::findOrFail($produk_id);
        $produk->update($request->all());
        return redirect()->route('produk')->with('success','Data produk berhasil diperbarui!');
    }
    public function deleteproduk($produk_id){
        $produk= Produk::findOrFail($produk_id);
        $produk->delete();
        return redirect()->route('produk')->with('danager','Data produk berhasil dihapus!');
    }
    public function reportproduk(){
    $status = request('status');
        if ($status =="Ada") {
            $produk = Produk::where('stok','>',0)->get();
        } elseif($status == "Habis") {
            $produk = Produk::where('stok','=',0)->get();
        }
    return view('produk.reportproduk')->with(compact('status','produk'));
    }
}
