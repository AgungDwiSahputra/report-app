<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'laporan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'jenis_laporan',
        'judul_laporan',
        'status',
    ];
}
