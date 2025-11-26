<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    use HasFactory;

    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';

    protected $fillable = [
        'nama_perawat',
        'jenis_kelamin',
        'tingkat_pendidikan',
        'no_str',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'foto',
        'jadwal_kerja',
        'status_aktif'
    ];

    protected $casts = [
        'jadwal_kerja' => 'array',
        'status_aktif' => 'boolean',
        'tanggal_lahir' => 'date'
    ];

    public function getRouteKeyName()
    {
        return 'id_perawat';
    }
}