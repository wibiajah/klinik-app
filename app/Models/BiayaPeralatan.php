<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BiayaPeralatan extends Model
{
    use HasFactory;

    protected $table = 'biaya_peralatan';

    protected $fillable = [
        'kategori',
        'nama_alat',
        'merek',
        'model',
        'nomor_seri',
        'tahun_pembelian',
        'harga_beli',
        'biaya_operasional',
        'biaya_perawatan',
        'status',
        'lokasi',
        'penanggung_jawab',
        'keterangan',
        'gambar',
        'tanggal_maintenance_terakhir',
        'tanggal_maintenance_selanjutnya',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'harga_beli' => 'decimal:2',
        'biaya_operasional' => 'decimal:2',
        'biaya_perawatan' => 'decimal:2',
        'tanggal_maintenance_terakhir' => 'date',
        'tanggal_maintenance_selanjutnya' => 'date',
    ];

    /**
     * Get the total biaya per alat
     */
    public function getTotalBiayaAttribute()
    {
        return $this->harga_beli + $this->biaya_operasional + $this->biaya_perawatan;
    }

    /**
     * Get the full path for gambar
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return Storage::url($this->gambar);
        }
        return asset('images/no-image.png'); // Default image
    }

    /**
     * Get formatted harga beli
     */
    public function getFormattedHargaBeliAttribute()
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    /**
     * Get formatted biaya operasional
     */
    public function getFormattedBiayaOperasionalAttribute()
    {
        return 'Rp ' . number_format($this->biaya_operasional, 0, ',', '.');
    }

    /**
     * Get formatted biaya perawatan
     */
    public function getFormattedBiayaPerawatanAttribute()
    {
        return 'Rp ' . number_format($this->biaya_perawatan, 0, ',', '.');
    }

    /**
     * Get formatted total biaya
     */
    public function getFormattedTotalBiayaAttribute()
    {
        return 'Rp ' . number_format($this->total_biaya, 0, ',', '.');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'aktif':
                return 'badge-success';
            case 'tidak_aktif':
                return 'badge-secondary';
            case 'rusak':
                return 'badge-danger';
            case 'maintenance':
                return 'badge-warning';
            default:
                return 'badge-secondary';
        }
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 'aktif':
                return 'Aktif';
            case 'tidak_aktif':
                return 'Tidak Aktif';
            case 'rusak':
                return 'Rusak';
            case 'maintenance':
                return 'Maintenance';
            default:
                return 'Unknown';
        }
    }

    /**
     * Get kategori text
     */
    public function getKategoriTextAttribute()
    {
        switch ($this->kategori) {
            case 'pemeriksaan-umum':
                return 'Pemeriksaan Umum';
            case 'laboratorium':
                return 'Laboratorium';
            case 'radiologi':
                return 'Radiologi';
            default:
                return ucfirst($this->kategori);
        }
    }

    /**
     * Check if maintenance is due
     */
    public function getIsMaintenanceDueAttribute()
    {
        if (!$this->tanggal_maintenance_selanjutnya) {
            return false;
        }

        return $this->tanggal_maintenance_selanjutnya <= now()->addDays(7);
    }

    /**
     * Get umur alat in years
     */
    public function getUmurAlatAttribute()
    {
        if (!$this->tahun_pembelian) {
            return null;
        }

        return now()->year - $this->tahun_pembelian;
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter alat yang butuh maintenance
     */
    public function scopeMaintenanceDue($query)
    {
        return $query->whereNotNull('tanggal_maintenance_selanjutnya')
                    ->where('tanggal_maintenance_selanjutnya', '<=', now()->addDays(7));
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_alat', 'like', "%{$search}%")
              ->orWhere('merek', 'like', "%{$search}%")
              ->orWhere('model', 'like', "%{$search}%")
              ->orWhere('nomor_seri', 'like', "%{$search}%")
              ->orWhere('lokasi', 'like', "%{$search}%")
              ->orWhere('penanggung_jawab', 'like', "%{$search}%");
        });
    }

    /**
     * Get created by user
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get updated by user
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}