<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detail_laporan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_laporan',
        'dibuat_oleh',
        'diterima_oleh',
        'wilayah_asal',
        'hal_menonjol',
        'cuaca',
        'jml_personil',
        'personil_hadir',
        'personil_kurang',
        'dinas_dalam',
        'dinas_luar',
        'piket_pos',
        'materil',
        'tembusan',
        'lampiran',
    ];

    // Relasi ke model Laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
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
