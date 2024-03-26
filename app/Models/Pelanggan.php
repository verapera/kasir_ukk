<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',
    ];
}
