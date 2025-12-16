<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    protected $table = 'tb_detailpen';
    //protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        'id_siswa',
        'tanggal_pembayaran',
        'jumlah_pembayaran',
        'metode_pembayaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
