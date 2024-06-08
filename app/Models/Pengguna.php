<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    // use HasFactory;
    use Notifiable;
    
    protected $table = 'pengguna';

    protected $fillable = [
        'foto_profil',
        'nama_lengkap',
        'kata_sandi',
        'email',
        'no_telp',
        'NPWP',
        'NRP',
        'tgl_lahir',
        'jabatan',
        'penempatan',
        'level',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
