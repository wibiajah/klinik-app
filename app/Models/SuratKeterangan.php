<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratKeterangan extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan';

    protected $fillable = [
        'type',
        'jenis_surat',
        'content',
        'printed_at',
        'printed_by',
    ];

    protected $casts = [
        'printed_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'printed_by');
    }

    // Scopes untuk type
    public function scopeTemplate($query)
    {
        return $query->where('type', 'template');
    }

    public function scopeHistory($query)
    {
        return $query->where('type', 'history');
    }

    // Scopes untuk jenis surat
    public function scopeSehat($query)
    {
        return $query->where('jenis_surat', 'sehat');
    }

    public function scopeSakit($query)
    {
        return $query->where('jenis_surat', 'sakit');
    }

    // Helper methods
    public static function getTemplateSehat()
    {
        return self::template()->sehat()->first();
    }

    public static function getTemplateSakit()
    {
        return self::template()->sakit()->first();
    }

    public static function getHistorySehat()
    {
        return self::history()->sehat()->with('user')->latest('printed_at')->get();
    }

    public static function getHistorySakit()
    {
        return self::history()->sakit()->with('user')->latest('printed_at')->get();
    }

    public static function getAllHistory()
    {
        return self::history()->with('user')->latest('printed_at')->get();
    }

    // Method untuk simpan history
    public static function saveHistory($jenisSurat, $userId = null)
    {
        return self::create([
            'type' => 'history',
            'jenis_surat' => $jenisSurat,
            'printed_at' => now(),
            'printed_by' => $userId ?? auth()->id(),
        ]);
    }
}