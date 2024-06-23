<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detail_pengajuan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_pengajuan',
        'dibuat_oleh',
        'diterima_oleh',
        'wilayah_asal',
        'diperintahkan_kepada',
        'tembusan',
    ];

    // Relasi ke model Pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

    // Relasi ke model Pengguna untuk dibuat_oleh
    public function pembuat()
    {
        return $this->belongsTo(Pengguna::class, 'dibuat_oleh');
    }

    // Relasi ke model Pengguna untuk diterima_oleh
    public function penerima()
    {
        return $this->belongsTo(Pengguna::class, 'diterima_oleh');
    }
}
