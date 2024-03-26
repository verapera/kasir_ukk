<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    //
    public function index(){
        $penjualan = Penjualan::with('pelanggans')
                    ->where('tanggal',date('Y-m-d'))
                    ->get();
        $pelanggan = Pelanggan::all();
        return view('penjualan.index')->with(compact('penjualan','pelanggan'));
    }
    public function transaksi($pelanggan_id){
        $pelanggan = Pelanggan::findOrFail($pelanggan_id);
        $produk    = Produk::where('stok','>',0)->orderBy('nama_produk','ASC')->get();
        $temp      = DB::table('temps as a')
                    ->leftJoin('produks as b','a.produk_id','=','b.produk_id')
                    ->where('a.user_id',auth()->user()->user_id)
                    ->where('a.pelanggan_id',$pelanggan_id)
                    ->get();
        $data = [
            'pelanggan' =>$pelanggan,
            'pelanggan_id' =>$pelanggan_id,
            'produk' =>$produk,
            'temp' =>$temp,
        ];
        return view('penjualan.transaksi',$data);
    }
    public function addtemp(Request $request,$pelanggan_id){
        $produk = Produk::where('produk_id',$request->produk_id)->first();
        $stoklama = $produk->stok;
        $temp = Temp::where('produk_id',$request->produk_id)
                     ->where('pelanggan_id',$request->pelanggan_id)
                     ->where('user_id',$request->user_id)
                     ->first();
        if ($stoklama <$request->jumlah) {
            # code...
            return redirect()->back()->with('danger','Stok tidak mencukupi!');
        } elseif($temp!==NULL) {
            # code...
            $temp->jumlah+=$request->jumlah;
            $temp->save();
            return redirect()->back()->with('success','Jumlah produk berhasil diupdate!');
        }else{
            Temp::create($request->all());
            return redirect()->back()->with('success','Produk berhasil ditambah keranjang!');
        }
    }
    public function bayar(Request $request,$pelanggan_id){
        $jumlah = Penjualan::whereRaw("DATE_FORMAT(tanggal,'%Y-%m')=?",date('Y-m'))->count();
        $nota   = date('ymd').($jumlah+1);
        $temp   = DB::table('temps as a')
                ->leftJoin('produks as b','a.produk_id','=','b.produk_id')
                ->where('a.user_id',auth()->user()->user_id)
                ->where('a.pelanggan_id',$pelanggan_id)
                ->get();
        foreach($temp as $item){
            if ($item->stok <$item->jumlah) {
                # code...
                return redirect()->back()->with('danger','Stok tidak mencukupi!');
            } 
            DetailPenjualan::create([
                'kode_penjualan'=>$nota,
                'produk_id'=>$item->produk_id,
                'subtotal'=>$item->jumlah*$item->harga,
                'jumlah'=>$item->jumlah,
            ]);
            Produk::where('produk_id',$item->produk_id)
                    ->update(['stok' => $item->stok-$item->jumlah]);
        }
        $val = Validator::make($request->all(),[
            'bayar' => 'required|numeric|min:'.$request->total_harga,
        ]);
        if ($val->fails()) {
            # code...
            return back()
            ->withErrors($val)
            ->with('danger','Pembayaran tidak mencukupi')
            ->withInput();
        }
        Penjualan::create([
            'kode_penjualan'=>$nota,
            'tanggal'=>date('Y-m-d'),
            'bayar'=>$request->bayar,
            'total_harga'=>$request->total_harga,
            'user_id'=>$request->user_id,
            'pelanggan_id'=>$request->pelanggan_id,
        ]);
        Temp::where('user_id',$request->user_id)
        ->where('pelanggan_id',$request->pelanggan_id)
        ->delete();
        return redirect()->route('invoice',$nota)->with('success','Transaksi berhasil');
    }
    public function deletetemp($temp_id){
        $temp = Temp::findOrFail($temp_id);
        $temp->delete();
        return redirect()->back()->with('danager','Produk berhasil dihapus dari keranjang!');
    }
    public function invoice($kode_penjualan){
        $detail = DB::table('detail_penjualans as a')
                ->leftJoin('produks as b','a.produk_id','=','b.produk_id')
                ->where('kode_penjualan',$kode_penjualan)
                ->get();
        $penjualan = DB::table('penjualans as a')
                ->leftJoin('pelanggans as b','a.pelanggan_id','=','b.pelanggan_id')
                ->where('kode_penjualan',$kode_penjualan)
                ->first();
        $users = DB::table('penjualans as a')
                ->leftJoin('users as b','a.user_id','=','b.user_id')
                ->first();
        $nota = $kode_penjualan;
        $data = [
            'detail'=>$detail,
            'penjualan'=>$penjualan,
            'users'=>$users,
            'nota'=>$kode_penjualan,
        ];
        return view('penjualan.invoice',$data);
    }
    public function struk($kode_penjualan){
        $detail = DB::table('detail_penjualans as a')
                ->leftJoin('produks as b','a.produk_id','=','b.produk_id')
                ->where('kode_penjualan',$kode_penjualan)
                ->get();
        $penjualan = DB::table('penjualans as a')
                ->leftJoin('pelanggans as b','a.pelanggan_id','=','b.pelanggan_id')
                ->where('kode_penjualan',$kode_penjualan)
                ->first();
        $users = DB::table('penjualans as a')
                ->leftJoin('users as b','a.user_id','=','b.user_id')
                ->first();
        $nota = $kode_penjualan;
        $data = [
            'detail'=>$detail,
            'penjualan'=>$penjualan,
            'users'=>$users,
            'nota'=>$kode_penjualan,
        ];
        return view('penjualan.struk',$data);
    }
    public function reportpenjualan(){
        $dari = request('dari');
        $sampai = request('sampai');
        $penjualan = Penjualan::with('pelanggans')
                    ->where('tanggal','>=',$dari)
                    ->where('tanggal','<=',$sampai)
                    ->get();
        $data =[
            'dari' => $dari,
            'sampai' => $sampai,
            'penjualan' => $penjualan,
        ];
        return view('penjualan.reportpenjualan',$data);
    }
}
