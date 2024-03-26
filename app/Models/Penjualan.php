<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'penjualan_id';
    protected $fillable = [
        'kode_penjualan',
        'tanggal',
        'bayar',
        'total_harga',
        'user_id',
        'pelanggan_id',
    ];
    public function pelanggans(){
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }
}
