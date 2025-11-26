<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';

    protected $fillable = [
        'nama_dokter',
        'jenis_kelamin',
        'spesialisasi',
        'no_str',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'jadwal_praktik',
        'foto',
        'status_aktif'
    ];

    protected $casts = [
        'jadwal_praktik' => 'array',
        'tanggal_lahir' => 'date',
        'status_aktif' => 'boolean'
    ];
}