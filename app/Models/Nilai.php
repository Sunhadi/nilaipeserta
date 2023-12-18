<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'nim',
        'nama_peserta',
        'nama_fasilitator',
        'nilai_akhir',
        'presensi',
        'total_nilai',
        'konversi_nilai',
        'tahun',
    ];
}
