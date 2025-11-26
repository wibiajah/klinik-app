<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'no_hp',
        'email', // Tambahan field email
        'no_bpjs',
        'alamat_lengkap',
        'kontak_darurat',
        'hubungan_kontak',
        'keluhan',
        'catatan',
        'tgl_pendaftaran',
        'status',
        'no_rekam_medis',
        'waktu_submit',
        'is_lpk_sentosa',
        'transferred_by', // ID user yang melakukan transfer
        'transferred_at',
        'foto_bukti' // TAMBAH INI// Waktu transfer
        
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_pendaftaran' => 'date',
        'waktu_submit' => 'datetime',
         'is_lpk_sentosa' => 'boolean',
         'transferred_at' => 'datetime',
    ];

    /**
     * Cek apakah NIK sudah pernah dikonfirmasi sebelumnya
     */
    public static function isNikConfirmed($nik)
    {
        return self::where('nik', $nik)
                  ->where('status', 'dikonfirmasi')
                  ->exists();
    }

    /**
     * Ambil no rekam medis dari pendaftaran pertama yang dikonfirmasi
     */
    public static function getNoRekamMedisByNik($nik)
    {
        $pendaftaran = self::where('nik', $nik)
                          ->where('status', 'dikonfirmasi')
                          ->whereNotNull('no_rekam_medis')
                          ->first();
        
        return $pendaftaran ? $pendaftaran->no_rekam_medis : null;
    }

    /**
     * Cek apakah NIK masih ada pendaftaran yang menunggu konfirmasi
     */
    public static function hasWaitingRegistration($nik)
    {
        return self::where('nik', $nik)
                  ->where('status', 'menunggu')
                  ->exists();
    }

    // Generate nomor rekam medis - HANYA dipanggil saat konfirmasi PERTAMA KALI
    public function generateNoRekamMedis()
    {
        // Pastikan waktu_submit ada
        if (!$this->waktu_submit) {
            $this->waktu_submit = Carbon::now();
            $this->save();
        }

        // Gunakan tahun sekarang
        $tahunSekarang = Carbon::now()->format('Y');
        
        // Ambil hari dan bulan dari waktu_submit (format: ddmm)
        $hariBulan = Carbon::parse($this->waktu_submit)->format('dm');
        
        // Validasi NIK tidak kosong dan minimal 3 digit
        if (!$this->nik || strlen($this->nik) < 3) {
            throw new \Exception('NIK tidak valid untuk generate nomor rekam medis');
        }
        
        // Ambil 3 digit terakhir dari NIK
        $tigaDigitTerakhirNik = substr($this->nik, -3);
        
        // Format: TAHUN + HARI_BULAN + 3_DIGIT_NIK
        // Contoh: 2025 + 0104 + 123 = 20250104123
        return $tahunSekarang . $hariBulan . $tigaDigitTerakhirNik;
    }

    /**
     * Set no rekam medis untuk kunjungan berikutnya (ambil dari pendaftaran sebelumnya)
     */
    public function setExistingNoRekamMedis()
    {
        $noRekamMedis = self::getNoRekamMedisByNik($this->nik);
        if ($noRekamMedis) {
            $this->no_rekam_medis = $noRekamMedis;
            $this->save();
            return $noRekamMedis;
        }
        return null;
    }

    // Accessor untuk mendapatkan waktu submit yang terformat
    public function getWaktuSubmitFormattedAttribute()
    {
        return $this->waktu_submit ? 
            $this->waktu_submit->format('d/m/Y H:i:s') : 
            '-';
    }

    // Accessor untuk mendapatkan tanggal submit saja
    public function getTanggalSubmitAttribute()
    {
        return $this->waktu_submit ? 
            $this->waktu_submit->format('d/m/Y') : 
            '-';
    }

    // Accessor untuk mendapatkan jam submit saja  
    public function getJamSubmitAttribute()
    {
        return $this->waktu_submit ? 
            $this->waktu_submit->format('H:i:s') : 
            '-';
    }

    // Accessor untuk mendapatkan waktu submit dalam format Indonesia
    public function getWaktuSubmitIndonesiaAttribute()
    {
        if (!$this->waktu_submit) return '-';
        
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $tanggal = $this->waktu_submit->format('d');
        $bulanNama = $bulan[(int)$this->waktu_submit->format('n')];
        $tahun = $this->waktu_submit->format('Y');
        $jam = $this->waktu_submit->format('H:i:s');
        
        return "{$tanggal} {$bulanNama} {$tahun} pukul {$jam} WIB";
    }

    // Accessor untuk menampilkan no_rekam_medis atau status belum dikonfirmasi
    public function getNoRekamMedisDisplayAttribute()
    {
        if ($this->no_rekam_medis) {
            return $this->no_rekam_medis;
        }
        
        return $this->status === 'menunggu' ? 'Menunggu Konfirmasi' : '-';
    }

    // Scope untuk filter berdasarkan tanggal pendaftaran
    public function scopeByTanggalPendaftaran($query, $tanggal)
    {
        return $query->whereDate('tgl_pendaftaran', $tanggal);
    }

    // Scope untuk filter berdasarkan waktu submit
    public function scopeByWaktuSubmit($query, $tanggal)
    {
        return $query->whereDate('waktu_submit', $tanggal);
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter berdasarkan keluhan
    public function scopeByKeluhan($query, $keluhan)
    {
        return $query->where('keluhan', $keluhan);
    }

    // Accessor untuk format jenis kelamin
    public function getJenisKelaminLabelAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Accessor untuk format hubungan kontak
    public function getHubunganKontakLabelAttribute()
    {
        return ucfirst($this->hubungan_kontak);
    }

    // Accessor untuk format keluhan
    public function getKeluhanLabelAttribute()
    {
        switch ($this->keluhan) {
            case 'pemeriksaan_umum':
                return 'Pemeriksaan Umum';
            case 'lab':
                return 'Laboratorium';
            case 'radiologi':
                return 'Radiologi';
            default:
                return ucfirst($this->keluhan);
        }
    }

    // Accessor untuk format status
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'menunggu':
                return 'Menunggu Konfirmasi';
            case 'dikonfirmasi':
                return 'Dikonfirmasi';
            case 'ditolak':
                return 'Ditolak';
            default:
                return ucfirst($this->status);
        }
    }

    public function pemeriksaanUmum()
    {
        return $this->hasOne(PemeriksaanUmum::class);
    }

    public function isTransferredToPemeriksaanUmum()
    {
        return $this->pemeriksaanUmum()->exists();
    }

    public function laboratorium()
    {
        return $this->hasOne(Laboratorium::class);
    }

    public function isTransferredToLaboratorium()
    {
        return $this->laboratorium()->exists();
    }

    public function radiologi()
    {
        return $this->hasOne(Radiologi::class);
    }

    public function isTransferredToRadiologi()
    {
        return $this->radiologi()->exists();
    }

    public function transferredBy()
{
    return $this->belongsTo(User::class, 'transferred_by');
}
}