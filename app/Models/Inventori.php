<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventori extends Model
{
    use HasFactory;
    protected $table = 'inventoris';
    protected $fillable = [
        'Nama_Barang',
        'Kategori',
        'Jumlah_Barang',
        'Status'
    ];
}
