<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelAnggota extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'Nama_Anggota',
        'Jenis_Kelamin',
        'Usia',
        'Jabatan',
        'Status_Pekerjaan',
        'Status',
        'user_id'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'member_id');
    }
}
