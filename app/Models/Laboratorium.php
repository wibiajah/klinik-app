<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Laboratorium extends Model
{
    protected $table = 'laboratorium';

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
        'hasil_lab',
        'dokter_pemeriksa',
        'tgl_pemeriksaan',
        'catatan_lab',
        'no_antrian',
        'is_lpk_sentosa',
        'set_antrian_by',
'set_antrian_at', 
'mulai_periksa_by',
'mulai_periksa_at',
'selesai_periksa_by',
'selesai_periksa_at',
'foto_bukti' // TAMBAH INI
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_pemeriksaan' => 'date',
        'is_lpk_sentosa' => 'boolean',
        'set_antrian_at' => 'datetime',
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
 * Relasi ke User yang melakukan set antrian
 */
public function userSetAntrian()
{
    return $this->belongsTo(User::class, 'set_antrian_by');
}

/**
 * Relasi ke User yang memulai pemeriksaan
 */
public function userMulaiPeriksa()
{
    return $this->belongsTo(User::class, 'mulai_periksa_by');
}

/**
 * Relasi ke User yang menyelesaikan pemeriksaan
 */
public function userSelesaiPeriksa()
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
                return $this->no_antrian ? 'Antrian ' . $this->no_antrian : 'Menunggu Antrian';
            case 'sedang_diperiksa':
                return 'Sedang Diperiksa';
            case 'selesai':
                return 'Selesai';
            default:
                return ucfirst($this->status_pemeriksaan);
        }
    }

    /**
     * Generate nomor antrian unik dengan database transaction
     * Tanpa mengubah struktur database
     */
    public static function generateNoAntrian($tanggal = null)
    {
        $tanggal = $tanggal ?? Carbon::today();
        
        return DB::transaction(function () use ($tanggal) {
            // Ambil semua nomor antrian yang sudah ada untuk tanggal tersebut
            $existingNumbers = static::whereDate('tgl_pemeriksaan', $tanggal)
                                   ->whereNotNull('no_antrian')
                                   ->pluck('no_antrian')
                                   ->map(function($noAntrian) {
                                       // Extract angka dari format LAB-XX
                                       return (int) substr($noAntrian, 4);
                                   })
                                   ->sort()
                                   ->values()
                                   ->toArray();
            
            // Cari nomor berikutnya yang belum digunakan
            $nextNumber = 1;
            foreach ($existingNumbers as $number) {
                if ($number == $nextNumber) {
                    $nextNumber++;
                } else {
                    break; // Ada gap, gunakan nomor yang kosong
                }
            }
            
            return 'LAB-' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Alternative method: Generate dengan retry dan validasi
     */
    public static function generateUniqueNoAntrian($tanggal = null, $maxRetries = 10)
    {
        $tanggal = $tanggal ?? Carbon::today();
        
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            // Cari nomor tertinggi yang sudah ada
            $lastRecord = static::whereDate('tgl_pemeriksaan', $tanggal)
                               ->whereNotNull('no_antrian')
                               ->orderByRaw('CAST(SUBSTRING(no_antrian, 5) AS UNSIGNED) DESC')
                               ->first();
            
            if (!$lastRecord) {
                $nextNumber = 1;
            } else {
                $lastNumber = (int) substr($lastRecord->no_antrian, 4);
                $nextNumber = $lastNumber + 1;
            }
            
            $candidateNumber = 'LAB-' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
            
            // Cek apakah nomor sudah digunakan
            $exists = static::whereDate('tgl_pemeriksaan', $tanggal)
                           ->where('no_antrian', $candidateNumber)
                           ->exists();
            
            if (!$exists) {
                return $candidateNumber;
            }
            
            // Jika sudah ada, tunggu sebentar sebelum retry
            if ($attempt < $maxRetries) {
                usleep(rand(50000, 150000)); // Random delay 0.05-0.15 detik
            }
        }
        
        throw new \Exception("Gagal generate nomor antrian unik setelah {$maxRetries} percobaan");
    }
}