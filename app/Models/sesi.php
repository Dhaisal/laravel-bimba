<?php

// app/Models/Sesi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'tb_sesi';
    protected $primaryKey = 'id_sesi';
    protected $fillable = ['nama_sesi', 'deskripsi'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_sesi', 'id_sesi');
    }
}

