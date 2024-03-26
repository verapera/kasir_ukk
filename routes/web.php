<?php

use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        $p1_date = Carbon::today()->toDateString();
        $p1      = Penjualan::where('tanggal',$p1_date)->sum('total_harga'); 
        $p2_date = Carbon::yesterday()->toDateString();
        $p2      = Penjualan::where('tanggal',$p2_date)->sum('total_harga'); 
        $p3_date = Carbon::yesterday()->subDays(1)->toDateString();
        $p3      = Penjualan::where('tanggal',$p3_date)->sum('total_harga'); 
        $p4_date = Carbon::yesterday()->subDays(2)->toDateString();
        $p4      = Penjualan::where('tanggal',$p4_date)->sum('total_harga'); 
        $p5_date = Carbon::yesterday()->subDays(1)->toDateString();
        $p5      = Penjualan::where('tanggal',$p5_date)->sum('total_harga'); 
    
        return view('index')->with(compact('p1_date','p1','p2_date','p2','p3_date','p3','p4_date','p4','p5_date','p5'));
    });
    Route::controller(ProdukController::class)->group(function(){
        Route::get('produk','index')->name('produk');
        Route::get('reportproduk','reportproduk')->name('reportproduk');
        Route::post('addproduk','addproduk')->name('addproduk');
        Route::get('showproduk/{produk_id}','showproduk')->name('showproduk');
        Route::put('updateproduk/{produk_id}','updateproduk')->name('updateproduk');
        Route::delete('deleteproduk/{produk_id}','deleteproduk')->name('deleteproduk');
    });
    Route::controller(PelangganController::class)->middleware('kasir')->group(function(){
        Route::get('pelanggan','index')->name('pelanggan');
        Route::post('addpelanggan','addpelanggan')->name('addpelanggan');
        Route::get('showpelanggan/{pelanggan_id}','showpelanggan')->name('showpelanggan');
        Route::put('updatepelanggan/{pelanggan_id}','updatepelanggan')->name('updatepelanggan');
        Route::delete('deletepelanggan/{pelanggan_id}','deletepelanggan')->name('deletepelanggan');
    });
    Route::controller(PenggunaController::class)->middleware('admin')->group(function(){
        Route::get('pengguna','index')->name('pengguna');
        Route::post('addpengguna','addpengguna')->name('addpengguna');
        Route::get('showpengguna/{user_id}','showpengguna')->name('showpengguna');
        Route::put('updatepengguna/{user_id}','updatepengguna')->name('updatepengguna');
        Route::delete('deletepengguna/{user_id}','deletepengguna')->name('deletepengguna');
    });
    Route::controller(PenjualanController::class)->group(function(){
        Route::get('penjualan','index')->name('penjualan');
        Route::get('reportpenjualan','reportpenjualan')->name('reportpenjualan');
        Route::get('transaksi/{pelanggan_id}','transaksi')->name('transaksi');
        Route::post('addtemp/{pelanggan_id}','addtemp')->name('addtemp');
        Route::post('bayar/{pelanggan_id}','bayar')->name('bayar');
        Route::get('invoice/{kode_penjualan}','invoice')->name('invoice');
        Route::get('struk/{kode_penjualan}','struk')->name('struk');
        Route::delete('deletetemp/{temp_id}','deletetemp')->name('deletetemp');
    });
});
Route::controller(AuthController::class)->group(function(){
    Route::get('login','showlogin')->name('login');
    Route::post('login','login');
    Route::get('logout','logout')->name('logout');
});
