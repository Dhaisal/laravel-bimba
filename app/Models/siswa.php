<?php

// app/Models/Sis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'id_sesi',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nama_ortu',
        'no_ortu',
        'foto_diri',
        'foto_kk',
        'foto_akta',
    ];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id_sesi');
    }

    public function pembayaran()
    {
        return $this->hasMany(DetailPembayaran::class, 'id_siswa', 'id_siswa');
    }
}

