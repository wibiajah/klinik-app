<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PemeriksaanUmum extends Model
{
    protected $table = 'pemeriksaan_umum';

    protected $fillable = [
        'pendaftaran_id',
        'no_rekam_medis',
        'nik',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'no_hp',
        'email', // TAMBAHAN BARU
        'no_bpjs',
        'alamat_lengkap',
        'kontak_darurat',
        'hubungan_kontak',
        'catatan',
        'tgl_transfer',
        'no_antrian',
        'status_pemeriksaan',
        'diagnosis_sementara',
        'obat_diberikan',
        'anjuran_instruksi',
        'rujukan',
        'waktu_konfirmasi',
        'waktu_mulai_periksa',
        'waktu_selesai_periksa',
        'is_lpk_sentosa', // TAMBAHAN BARU
        'konfirmasi_by',
        'mulai_periksa_by', 
        'selesai_periksa_by',
        'foto_bukti'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_transfer' => 'date',
        'waktu_konfirmasi' => 'datetime',
        'waktu_mulai_periksa' => 'datetime',
        'waktu_selesai_periksa' => 'datetime',
        'is_lpk_sentosa' => 'boolean', // TAMBAHAN BARU
    ];

    // Relasi ke tabel pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function konfirmasiBy()
{
    return $this->belongsTo(User::class, 'konfirmasi_by');
}

public function mulaiPeriksaBy()
{
    return $this->belongsTo(User::class, 'mulai_periksa_by');
}

public function selesaiPeriksaBy()
{
    return $this->belongsTo(User::class, 'selesai_periksa_by');
}

    // Scope untuk filter berdasarkan tanggal transfer
    public function scopeByTanggalTransfer($query, $tanggal)
    {
        return $query->whereDate('tgl_transfer', $tanggal);
    }

    // Scope untuk filter berdasarkan status pemeriksaan
    public function scopeByStatusPemeriksaan($query, $status)
    {
        return $query->where('status_pemeriksaan', $status);
    }

    // Accessor untuk format jenis kelamin
    public function getJenisKelaminLabelAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Accessor untuk format status pemeriksaan
    public function getStatusPemeriksaanLabelAttribute()
    {
        switch ($this->status_pemeriksaan) {
            case 'menunggu':
                return 'Menunggu Konfirmasi';
            case 'dikonfirmasi':
                return 'Menunggu Pemeriksaan';
            case 'sedang_diperiksa':
                return 'Sedang Diperiksa';
            case 'selesai':
                return 'Selesai';
            default:
                return ucfirst($this->status_pemeriksaan);
        }
    }

    public static function generateNoAntrian($tanggal)
    {
        $lastRecord = self::whereDate('tgl_transfer', $tanggal)
                         ->whereNotNull('no_antrian')
                         ->orderBy('no_antrian', 'desc')
                         ->first();

        if ($lastRecord) {
            // Extract nomor dari format PKU-XX
            $lastNumber = (int) substr($lastRecord->no_antrian, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return 'PKU-' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    }
}