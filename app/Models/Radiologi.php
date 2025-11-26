<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radiologi extends Model
{
    protected $table = 'radiologi';

    protected $fillable = [
        'pendaftaran_id',
        'nik',
        'nama',
        'no_rekam_medis',
        'jenis_kelamin',
        'tgl_lahir',
        'no_hp',
        'email',
        'alamat_lengkap',
        'kontak_darurat',
        'hubungan_kontak',
        'keluhan',
        'status_pemeriksaan',
        'jenis_radiologi',
        'hasil_radiologi',
        'dokter_radiologi',
        'teknisi_radiologi',
        'tgl_pemeriksaan',
        'catatan_radiologi',
        'no_antrian',
        'transfer_by',          // ID user yang melakukan transfer dari pendaftaran
'antrian_by',          // ID user yang set antrian  
'mulai_periksa_by',    // ID user yang mulai pemeriksaan
'selesai_periksa_by', 
    'transfer_at',      // TAMBAH INI
    'antrian_at',       // TAMBAH INI
    'mulai_periksa_at', // TAMBAH INI
    'selesai_periksa_at', // ID user yang selesaikan pemeriksaan
        'is_lpk_sentosa',
        'foto_bukti' // TAMBAH INI
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_pemeriksaan' => 'date',
    'is_lpk_sentosa' => 'boolean',
    'transfer_at' => 'datetime',
    'antrian_at' => 'datetime',
    'mulai_periksa_at' => 'datetime',
    'selesai_periksa_at' => 'datetime',
    ];

    /**
     * Relasi ke model Pendaftaran
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
/**
 * Relasi ke user yang melakukan transfer
 */
public function transferBy()
{
    return $this->belongsTo(User::class, 'transfer_by');
}

/**
 * Relasi ke user yang set antrian
 */
public function antrianBy()
{
    return $this->belongsTo(User::class, 'antrian_by');
}

/**
 * Relasi ke user yang mulai pemeriksaan
 */
public function mulaiPeriksaBy()
{
    return $this->belongsTo(User::class, 'mulai_periksa_by');
}

/**
 * Relasi ke user yang selesaikan pemeriksaan
 */
public function selesaiPeriksaBy()
{
    return $this->belongsTo(User::class, 'selesai_periksa_by');
}
    /**
     * Scope untuk filter berdasarkan tanggal pemeriksaan
     */
    public function scopeByTanggalPemeriksaan($query, $tanggal)
    {
        return $query->whereDate('tgl_pemeriksaan', $tanggal);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_pemeriksaan', $status);
    }

    /**
     * Accessor untuk format jenis kelamin
     */
    public function getJenisKelaminLabelAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Accessor untuk format status
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status_pemeriksaan) {
            case 'menunggu':
                return 'Menunggu Pemeriksaan';
            case 'sedang_diperiksa':
                return 'Sedang Diperiksa';
            case 'selesai':
                return 'Selesai';
            default:
                return ucfirst($this->status_pemeriksaan);
        }
    }

    /**
     * Accessor untuk format jenis radiologi
     */
    public function getJenisRadiologiLabelAttribute()
    {
        switch ($this->jenis_radiologi) {
            case 'rontgen':
                return 'Rontgen';
            case 'ct_scan':
                return 'CT Scan';
            case 'mri':
                return 'MRI';
            case 'usg':
                return 'USG';
            case 'mammografi':
                return 'Mammografi';
            default:
                return ucfirst($this->jenis_radiologi);
        }
    }
}