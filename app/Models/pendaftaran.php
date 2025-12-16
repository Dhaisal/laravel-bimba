<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected $table = 'tb_pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    protected $model = pendaftaran::class;

    protected $guarded = [];

}
