<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'mails';
    protected $fillable = [
        'Jenis_Surat',
        'No_Surat',
        'Tanggal_Surat',
        'Perihal',
        'File',
        'Status',
        'Alasan'
    ];
    public function setDateAtribute($value)
    {
        $this->attributes['Tanggal_Surat'] = Carbon::createFromFormat('m/d/Y', $value)->format('d-m-Y');
    }
}
