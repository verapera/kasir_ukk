<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    use HasFactory;
    protected $table = 'temps';
    protected $primaryKey = 'temp_id';
    protected $fillable = [
        'pelanggan_id',
        'user_id',
        'produk_id',
        'jumlah',
    ];
}
