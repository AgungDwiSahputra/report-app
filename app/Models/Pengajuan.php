<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengajuan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'jenis_pengajuan',
        'judul_pengajuan',
        'status',
    ];
}
