<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangan';

    protected $fillable = [
        'member_id',
        'Nama_Anggota',
        'jumlah',
        'tanggal',
        'status_pembayaran'
    ];
    public function anggota()
    {
        return $this->belongsTo(KelAnggota::class, 'member_id');
    }
}
