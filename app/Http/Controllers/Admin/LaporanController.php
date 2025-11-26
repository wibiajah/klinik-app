<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\SuratKeterangan;
use App\Models\PemeriksaanUmum;
use App\Models\Laboratorium;
use App\Models\Radiologi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Laporan Pendaftaran
     */
    public function laporanPendaftaran(Request $request)
    {
        // Default periode hari ini
        $periode = $request->get('periode', 'hari_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        $filter_pasien = $request->get('filter_pasien', 'semua');

        $query = Pendaftaran::query();
        
        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('waktu_submit', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                break;
                
            case 'bulan_ini':
                $query->whereMonth('waktu_submit', Carbon::now()->month)
                      ->whereYear('waktu_submit', Carbon::now()->year);
                $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
                break;
                
            case 'custom':
                if ($tanggal_mulai && $tanggal_selesai) {
                    $query->whereBetween('waktu_submit', [
                        Carbon::parse($tanggal_mulai)->startOfDay(),
                        Carbon::parse($tanggal_selesai)->endOfDay()
                    ]);
                    $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
                } else {
                    // Jika custom tapi tanggal tidak lengkap, default ke hari ini
                    $query->whereDate('waktu_submit', Carbon::today());
                    $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                }
                break;
        }
        
        // Filter berdasarkan jenis pasien
if ($filter_pasien !== 'semua') {
    if ($filter_pasien === 'lpk_sentosa') {
        $query->where('is_lpk_sentosa', true);
    } elseif ($filter_pasien === 'umum') {
        $query->where('is_lpk_sentosa', false);
    }
}
        // Clone query untuk statistik
        $statistikQuery = clone $query;
        
        // Hitung data statistik
        $total_pendaftaran = $statistikQuery->count();
        $menunggu = (clone $statistikQuery)->where('status', 'menunggu')->count();
        $dikonfirmasi = (clone $statistikQuery)->where('status', 'dikonfirmasi')->count();
        $ditolak = (clone $statistikQuery)->where('status', 'ditolak')->count();
        
        // Hitung berdasarkan keluhan
        $pemeriksaan_umum = (clone $statistikQuery)->where('keluhan', 'pemeriksaan_umum')->count();
        $lab = (clone $statistikQuery)->where('keluhan', 'lab')->count();
        $radiologi = (clone $statistikQuery)->where('keluhan', 'radiologi')->count();
        
        // Hitung berdasarkan jenis kelamin
        $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
        
        // Ambil data pendaftaran untuk tabel dengan paginasi
        $pendaftaran = $query->orderBy('waktu_submit', 'desc')
                            ->paginate(20)
                            ->appends($request->all()); // Preserve query parameters in pagination
        
        return view('admin.laporanklinik.laporanpendaftaran', compact(
            'periode',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_periode',
            'filter_pasien', 
            'total_pendaftaran',
            'menunggu',
            'dikonfirmasi',
            'ditolak',
            'pemeriksaan_umum',
            'lab',
            'radiologi',
            'laki_laki',
            'perempuan',
            'pendaftaran'
        ));
    }
    
    /**
     * Laporan Pemeriksaan Umum
     */
    public function laporanPemeriksaanUmum(Request $request)
    {
        // Default periode hari ini
        $periode = $request->get('periode', 'hari_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        $filter_pasien = $request->get('filter_pasien', 'semua');

        $query = PemeriksaanUmum::query();
        
        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('tgl_transfer', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                break;
                
            case 'bulan_ini':
                $query->whereMonth('tgl_transfer', Carbon::now()->month)
                      ->whereYear('tgl_transfer', Carbon::now()->year);
                $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
                break;
                
            case 'custom':
                if ($tanggal_mulai && $tanggal_selesai) {
                    $query->whereBetween('tgl_transfer', [
                        Carbon::parse($tanggal_mulai)->startOfDay(),
                        Carbon::parse($tanggal_selesai)->endOfDay()
                    ]);
                    $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
                } else {
                    // Jika custom tapi tanggal tidak lengkap, default ke hari ini
                    $query->whereDate('tgl_transfer', Carbon::today());
                    $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                }
                break;
        }
        
        // Filter berdasarkan jenis pasien
if ($filter_pasien !== 'semua') {
    if ($filter_pasien === 'lpk_sentosa') {
        $query->where('is_lpk_sentosa', true);
    } elseif ($filter_pasien === 'umum') {
        $query->where('is_lpk_sentosa', false);
    }
}
        // Clone query untuk statistik
        $statistikQuery = clone $query;
        
        // Hitung data statistik berdasarkan status pemeriksaan
        $total_pemeriksaan = $statistikQuery->count();
        $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
        $dikonfirmasi = (clone $statistikQuery)->where('status_pemeriksaan', 'dikonfirmasi')->count();
        $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
        $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
        
        // Hitung berdasarkan jenis kelamin
        $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
        
        // Hitung berdasarkan rujukan
        $dengan_rujukan = (clone $statistikQuery)->whereNotNull('rujukan')
                                                  ->where('rujukan', '!=', '')
                                                  ->count();
        $tanpa_rujukan = $total_pemeriksaan - $dengan_rujukan;
        
        // Hitung berdasarkan is_lpk_sentosa
        $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
        $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
        
        // Ambil data pemeriksaan umum untuk tabel dengan paginasi
        $pemeriksaan_umum = $query->orderBy('tgl_transfer', 'desc')
                                  ->orderBy('no_antrian', 'asc')
                                  ->paginate(20)
                                  ->appends($request->all()); // Preserve query parameters in pagination
        
        return view('admin.laporanklinik.laporanpemeriksaanumum', compact(
            'periode',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_periode',
                'filter_pasien',
            'total_pemeriksaan',
            'menunggu',
            'dikonfirmasi',
            'sedang_diperiksa',
            'selesai',
            'laki_laki',
            'perempuan',
            'dengan_rujukan',
            'tanpa_rujukan',
            'lpk_sentosa',
            'umum',
            'pemeriksaan_umum'
        ));
    }
    
    public function laporanLaboratorium(Request $request)
{
    // Default periode hari ini
    $periode = $request->get('periode', 'hari_ini');
    $tanggal_mulai = $request->get('tanggal_mulai');
    $tanggal_selesai = $request->get('tanggal_selesai');
    $filter_pasien = $request->get('filter_pasien', 'semua');

    $query = \App\Models\Laboratorium::query();
    
    // Filter berdasarkan periode
    switch ($periode) {
        case 'hari_ini':
            $query->whereDate('tgl_pemeriksaan', Carbon::today());
            $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            break;
            
        case 'bulan_ini':
            $query->whereMonth('tgl_pemeriksaan', Carbon::now()->month)
                  ->whereYear('tgl_pemeriksaan', Carbon::now()->year);
            $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
            break;
            
        case 'custom':
            if ($tanggal_mulai && $tanggal_selesai) {
                $query->whereBetween('tgl_pemeriksaan', [
                    Carbon::parse($tanggal_mulai)->startOfDay(),
                    Carbon::parse($tanggal_selesai)->endOfDay()
                ]);
                $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
            } else {
                // Jika custom tapi tanggal tidak lengkap, default ke hari ini
                $query->whereDate('tgl_pemeriksaan', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            }
            break;
    }
    
    // Filter berdasarkan jenis pasien
if ($filter_pasien !== 'semua') {
    if ($filter_pasien === 'lpk_sentosa') {
        $query->where('is_lpk_sentosa', true);
    } elseif ($filter_pasien === 'umum') {
        $query->where('is_lpk_sentosa', false);
    }
}
    // Clone query untuk statistik
    $statistikQuery = clone $query;
    
    // Hitung data statistik berdasarkan status pemeriksaan
    $total_laboratorium = $statistikQuery->count();
    $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
    $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
    $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
    
    // Hitung berdasarkan jenis kelamin
    $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
    $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
    
    // Hitung berdasarkan hasil lab (hanya yang sudah selesai)
    $ada_hasil = (clone $statistikQuery)->whereNotNull('hasil_lab')
                                        ->where('hasil_lab', '!=', '')
                                        ->count();
    $belum_ada_hasil = $total_laboratorium - $ada_hasil;
    
    // Hitung berdasarkan is_lpk_sentosa
    $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
    $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
    
    // Hitung berdasarkan dokter pemeriksa (top 5)
    $dokter_stats = (clone $statistikQuery)->whereNotNull('dokter_pemeriksa')
                                           ->where('dokter_pemeriksa', '!=', '')
                                           ->selectRaw('dokter_pemeriksa, COUNT(*) as total')
                                           ->groupBy('dokter_pemeriksa')
                                           ->orderBy('total', 'desc')
                                           ->limit(5)
                                           ->get();
    
    // Ambil data laboratorium untuk tabel dengan paginasi
    $laboratorium = $query->orderBy('tgl_pemeriksaan', 'desc')
                          ->orderBy('no_antrian', 'asc')
                          ->paginate(20)
                          ->appends($request->all()); // Preserve query parameters in pagination
    
    // Tambahkan umur ke setiap item laboratorium
    $laboratorium->getCollection()->transform(function ($item) {
        $item->umur = $item->tgl_lahir ? Carbon::parse($item->tgl_lahir)->age : null;
        return $item;
    });
    
    return view('admin.laporanklinik.laporanlaboratorium', compact(
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'judul_periode',
        'filter_pasien',  
        'total_laboratorium',
        'menunggu',
        'sedang_diperiksa',
        'selesai',
        'laki_laki',
        'perempuan',
        'ada_hasil',
        'belum_ada_hasil',
        'lpk_sentosa',
        'umum',
        'dokter_stats',
        'laboratorium'
    ));
}
public function laporanRadiologi(Request $request)
{
    // Default periode hari ini
    $periode = $request->get('periode', 'hari_ini');
    $tanggal_mulai = $request->get('tanggal_mulai');
    $tanggal_selesai = $request->get('tanggal_selesai');
    $filter_pasien = $request->get('filter_pasien', 'semua');

    $query = \App\Models\Radiologi::query();
    
    // Filter berdasarkan periode
    switch ($periode) {
        case 'hari_ini':
            $query->whereDate('tgl_pemeriksaan', Carbon::today());
            $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            break;
            
        case 'bulan_ini':
            $query->whereMonth('tgl_pemeriksaan', Carbon::now()->month)
                  ->whereYear('tgl_pemeriksaan', Carbon::now()->year);
            $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
            break;
            
        case 'custom':
            if ($tanggal_mulai && $tanggal_selesai) {
                $query->whereBetween('tgl_pemeriksaan', [
                    Carbon::parse($tanggal_mulai)->startOfDay(),
                    Carbon::parse($tanggal_selesai)->endOfDay()
                ]);
                $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
            } else {
                // Jika custom tapi tanggal tidak lengkap, default ke hari ini
                $query->whereDate('tgl_pemeriksaan', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            }
            break;
    }
    
    // Filter berdasarkan jenis pasien
if ($filter_pasien !== 'semua') {
    if ($filter_pasien === 'lpk_sentosa') {
        $query->where('is_lpk_sentosa', true);
    } elseif ($filter_pasien === 'umum') {
        $query->where('is_lpk_sentosa', false);
    }
}
    // Clone query untuk statistik
    $statistikQuery = clone $query;
    
    // Hitung data statistik berdasarkan status pemeriksaan
    $total_radiologi = $statistikQuery->count();
    $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
    $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
    $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
    
    // Hitung berdasarkan jenis kelamin
    $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
    $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
    
    // Hitung berdasarkan jenis radiologi
    $rontgen = (clone $statistikQuery)->where('jenis_radiologi', 'rontgen')->count();
    $ct_scan = (clone $statistikQuery)->where('jenis_radiologi', 'ct_scan')->count();
    $mri = (clone $statistikQuery)->where('jenis_radiologi', 'mri')->count();
    $usg = (clone $statistikQuery)->where('jenis_radiologi', 'usg')->count();
    $mammografi = (clone $statistikQuery)->where('jenis_radiologi', 'mammografi')->count();
    
    // Hitung berdasarkan hasil radiologi (hanya yang sudah selesai)
    $ada_hasil = (clone $statistikQuery)->whereNotNull('hasil_radiologi')
                                        ->where('hasil_radiologi', '!=', '')
                                        ->count();
    $belum_ada_hasil = $total_radiologi - $ada_hasil;
    
    // Hitung berdasarkan is_lpk_sentosa
    $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
    $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
    
    // Hitung berdasarkan dokter radiologi (top 5)
    $dokter_stats = (clone $statistikQuery)->whereNotNull('dokter_radiologi')
                                           ->where('dokter_radiologi', '!=', '')
                                           ->selectRaw('dokter_radiologi, COUNT(*) as total')
                                           ->groupBy('dokter_radiologi')
                                           ->orderBy('total', 'desc')
                                           ->limit(5)
                                           ->get();
    
    // Hitung berdasarkan teknisi radiologi (top 5)
    $teknisi_stats = (clone $statistikQuery)->whereNotNull('teknisi_radiologi')
                                            ->where('teknisi_radiologi', '!=', '')
                                            ->selectRaw('teknisi_radiologi, COUNT(*) as total')
                                            ->groupBy('teknisi_radiologi')
                                            ->orderBy('total', 'desc')
                                            ->limit(5)
                                            ->get();
    
    // Ambil data radiologi untuk tabel dengan paginasi
    $radiologi = $query->orderBy('tgl_pemeriksaan', 'desc')
                       ->orderBy('no_antrian', 'asc')
                       ->paginate(20)
                       ->appends($request->all()); // Preserve query parameters in pagination
    
    // Tambahkan umur ke setiap item radiologi
    $radiologi->getCollection()->transform(function ($item) {
        $item->umur = $item->tgl_lahir ? Carbon::parse($item->tgl_lahir)->age : null;
        return $item;
    });
    
    return view('admin.laporanklinik.laporanradiologi', compact(
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'judul_periode',
        'filter_pasien',  
        'total_radiologi',
        'menunggu',
        'sedang_diperiksa',
        'selesai',
        'laki_laki',
        'perempuan',
        'rontgen',
        'ct_scan',
        'mri',
        'usg',
        'mammografi',
        'ada_hasil',
        'belum_ada_hasil',
        'lpk_sentosa',
        'umum',
        'dokter_stats',
        'teknisi_stats',
        'radiologi'
    ));
}
public function laporanSuratKeterangan(Request $request)
{
    // Default periode hari ini
    $periode = $request->get('periode', 'hari_ini');
    $tanggal_mulai = $request->get('tanggal_mulai');
    $tanggal_selesai = $request->get('tanggal_selesai');
    $jenis_surat = $request->get('jenis_surat', 'semua');
    
    $query = SuratKeterangan::history()->with('user');
    
    // Filter berdasarkan periode
    switch ($periode) {
        case 'hari_ini':
            $query->whereDate('printed_at', Carbon::today());
            $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            break;
            
        case 'bulan_ini':
            $query->whereMonth('printed_at', Carbon::now()->month)
                  ->whereYear('printed_at', Carbon::now()->year);
            $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
            break;
            
        case 'custom':
            if ($tanggal_mulai && $tanggal_selesai) {
                $query->whereBetween('printed_at', [
                    Carbon::parse($tanggal_mulai)->startOfDay(),
                    Carbon::parse($tanggal_selesai)->endOfDay()
                ]);
                $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
            } else {
                // Jika custom tapi tanggal tidak lengkap, default ke hari ini
                $query->whereDate('printed_at', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            }
            break;
    }
    
    // Filter berdasarkan jenis surat
    if ($jenis_surat !== 'semua') {
        $query->where('jenis_surat', $jenis_surat);
    }
    
    // Clone query untuk statistik
    $statistikQuery = clone $query;
    
    // Hitung data statistik
    $total_surat = $statistikQuery->count();
    $surat_sehat = (clone $statistikQuery)->where('jenis_surat', 'sehat')->count();
    $surat_sakit = (clone $statistikQuery)->where('jenis_surat', 'sakit')->count();
    
    // Statistik berdasarkan user yang mencetak
    $user_stats = (clone $statistikQuery)
        ->select('printed_by', \DB::raw('COUNT(*) as total'))
        ->groupBy('printed_by')
        ->with('user:id,name')
        ->get()
        ->map(function ($item) {
            return [
                'user_name' => $item->user->name ?? 'Unknown',
                'total' => $item->total
            ];
        });
    
    // Statistik harian (untuk periode bulan ini atau custom)
    $daily_stats = [];
    if ($periode === 'bulan_ini' || $periode === 'custom') {
        $daily_stats = (clone $statistikQuery)
            ->select(\DB::raw('DATE(printed_at) as tanggal'), \DB::raw('COUNT(*) as total'))
            ->groupBy(\DB::raw('DATE(printed_at)'))
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('d/m/Y'),
                    'total' => $item->total
                ];
            });
    }
    
    // Ambil data surat keterangan untuk tabel dengan paginasi
    $surat_keterangan = $query->orderBy('printed_at', 'desc')
                        ->paginate(20)
                        ->appends($request->all()); // Preserve query parameters in pagination
    
    return view('admin.laporanklinik.laporansuratketerangan', compact(
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_surat',
        'judul_periode',
        'total_surat',
        'surat_sehat',
        'surat_sakit',
        'user_stats',
        'daily_stats',
        'surat_keterangan'
    ));
}

/**
 * Export laporan surat keterangan ke PDF
 */
public function exportLaporanSuratKeterangan(Request $request)
{
    // Default periode hari ini
    $periode = $request->get('periode', 'hari_ini');
    $tanggal_mulai = $request->get('tanggal_mulai');
    $tanggal_selesai = $request->get('tanggal_selesai');
    $jenis_surat = $request->get('jenis_surat', 'semua');
    
    $query = SuratKeterangan::history()->with('user');
    
    // Filter berdasarkan periode
    switch ($periode) {
        case 'hari_ini':
            $query->whereDate('printed_at', Carbon::today());
            $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            break;
            
        case 'bulan_ini':
            $query->whereMonth('printed_at', Carbon::now()->month)
                  ->whereYear('printed_at', Carbon::now()->year);
            $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
            break;
            
        case 'custom':
            if ($tanggal_mulai && $tanggal_selesai) {
                $query->whereBetween('printed_at', [
                    Carbon::parse($tanggal_mulai)->startOfDay(),
                    Carbon::parse($tanggal_selesai)->endOfDay()
                ]);
                $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
            } else {
                $query->whereDate('printed_at', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            }
            break;
    }
    
    // Filter berdasarkan jenis surat
    if ($jenis_surat !== 'semua') {
        $query->where('jenis_surat', $jenis_surat);
    }
    
    // Clone query untuk statistik
    $statistikQuery = clone $query;
    
    // Hitung data statistik
    $total_surat = $statistikQuery->count();
    $surat_sehat = (clone $statistikQuery)->where('jenis_surat', 'sehat')->count();
    $surat_sakit = (clone $statistikQuery)->where('jenis_surat', 'sakit')->count();
    
    // Statistik berdasarkan user yang mencetak
    $user_stats = (clone $statistikQuery)
        ->select('printed_by', \DB::raw('COUNT(*) as total'))
        ->groupBy('printed_by')
        ->with('user:id,name')
        ->get()
        ->map(function ($item) {
            return [
                'user_name' => $item->user->name ?? 'Unknown',
                'total' => $item->total
            ];
        });
    
    // Statistik harian (untuk periode bulan ini atau custom)
    $daily_stats = [];
    if ($periode === 'bulan_ini' || $periode === 'custom') {
        $daily_stats = (clone $statistikQuery)
            ->select(\DB::raw('DATE(printed_at) as tanggal'), \DB::raw('COUNT(*) as total'))
            ->groupBy(\DB::raw('DATE(printed_at)'))
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('d/m/Y'),
                    'total' => $item->total
                ];
            });
    }
    
    // Ambil semua data untuk PDF (tanpa paginasi)
    $surat_keterangan = $query->orderBy('printed_at', 'desc')->get();
    
    $data = compact(
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_surat',
        'judul_periode',
        'total_surat',
        'surat_sehat',
        'surat_sakit',
        'user_stats',
        'daily_stats',
        'surat_keterangan'
    );
    
    $pdf = Pdf::loadView('admin.laporanklinik.pdf.suratketerangan', $data);
    $pdf->setPaper('A4', 'landscape');
    
    // Generate filename
    $jenis_filter = $jenis_surat === 'semua' ? 'semua' : $jenis_surat;
    $filename = 'laporan-surat-keterangan-' . $jenis_filter . '-' . str_replace(['/', ' ', '(', ')'], '-', $judul_periode) . '.pdf';
    
    return $pdf->download($filename);
}
/**
 * Export laporan radiologi ke PDF
 */
public function exportLaporanRadiologi(Request $request)
{
    // Default periode hari ini
    $periode = $request->get('periode', 'hari_ini');
    $tanggal_mulai = $request->get('tanggal_mulai');
    $tanggal_selesai = $request->get('tanggal_selesai');
    
    $query = \App\Models\Radiologi::query();
    
    // Filter berdasarkan periode
    switch ($periode) {
        case 'hari_ini':
            $query->whereDate('tgl_pemeriksaan', Carbon::today());
            $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            break;
            
        case 'bulan_ini':
            $query->whereMonth('tgl_pemeriksaan', Carbon::now()->month)
                  ->whereYear('tgl_pemeriksaan', Carbon::now()->year);
            $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
            break;
            
        case 'custom':
            if ($tanggal_mulai && $tanggal_selesai) {
                $query->whereBetween('tgl_pemeriksaan', [
                    Carbon::parse($tanggal_mulai)->startOfDay(),
                    Carbon::parse($tanggal_selesai)->endOfDay()
                ]);
                $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
            } else {
                $query->whereDate('tgl_pemeriksaan', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
            }
            break;
    }
    
    // Clone query untuk statistik
    $statistikQuery = clone $query;
    
    // Hitung data statistik berdasarkan status pemeriksaan
    $total_radiologi = $statistikQuery->count();
    $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
    $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
    $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
    
    // Hitung berdasarkan jenis kelamin
    $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
    $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
    
    // Hitung berdasarkan jenis radiologi
    $rontgen = (clone $statistikQuery)->where('jenis_radiologi', 'rontgen')->count();
    $ct_scan = (clone $statistikQuery)->where('jenis_radiologi', 'ct_scan')->count();
    $mri = (clone $statistikQuery)->where('jenis_radiologi', 'mri')->count();
    $usg = (clone $statistikQuery)->where('jenis_radiologi', 'usg')->count();
    $mammografi = (clone $statistikQuery)->where('jenis_radiologi', 'mammografi')->count();
    
    // Hitung berdasarkan hasil radiologi (hanya yang sudah selesai)
    $ada_hasil = (clone $statistikQuery)->whereNotNull('hasil_radiologi')
                                        ->where('hasil_radiologi', '!=', '')
                                        ->count();
    $belum_ada_hasil = $total_radiologi - $ada_hasil;
    
    // Hitung berdasarkan is_lpk_sentosa
    $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
    $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
    
    // Hitung berdasarkan dokter radiologi (top 5)
    $dokter_stats = (clone $statistikQuery)->whereNotNull('dokter_radiologi')
                                           ->where('dokter_radiologi', '!=', '')
                                           ->selectRaw('dokter_radiologi, COUNT(*) as total')
                                           ->groupBy('dokter_radiologi')
                                           ->orderBy('total', 'desc')
                                           ->limit(5)
                                           ->get();
    
    // Hitung berdasarkan teknisi radiologi (top 5)
    $teknisi_stats = (clone $statistikQuery)->whereNotNull('teknisi_radiologi')
                                            ->where('teknisi_radiologi', '!=', '')
                                            ->selectRaw('teknisi_radiologi, COUNT(*) as total')
                                            ->groupBy('teknisi_radiologi')
                                            ->orderBy('total', 'desc')
                                            ->limit(5)
                                            ->get();
    
    // Ambil semua data untuk PDF (tanpa paginasi)
    $radiologi = $query->orderBy('tgl_pemeriksaan', 'desc')
                       ->orderBy('no_antrian', 'asc')
                       ->get();
    
    $data = compact(
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'judul_periode',
        'total_radiologi',
        'menunggu',
        'sedang_diperiksa',
        'selesai',
        'laki_laki',
        'perempuan',
        'rontgen',
        'ct_scan',
        'mri',
        'usg',
        'mammografi',
        'ada_hasil',
        'belum_ada_hasil',
        'lpk_sentosa',
        'umum',
        'dokter_stats',
        'teknisi_stats',
        'radiologi'
    );
    
    $pdf = Pdf::loadView('admin.laporanklinik.pdf.radiologi', $data);
    $pdf->setPaper('A4', 'landscape');
    
    $filename = 'laporan-radiologi-' . str_replace(['/', ' ', '(', ')'], '-', $judul_periode) . '.pdf';
    
    return $pdf->download($filename);
}
    /**
     * Export laporan pendaftaran ke PDF
     */
    public function exportLaporanPendaftaran(Request $request)
    {
        // Default periode hari ini
        $periode = $request->get('periode', 'hari_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        
        $query = Pendaftaran::query();
        
        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('waktu_submit', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                break;
                
            case 'bulan_ini':
                $query->whereMonth('waktu_submit', Carbon::now()->month)
                      ->whereYear('waktu_submit', Carbon::now()->year);
                $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
                break;
                
            case 'custom':
                if ($tanggal_mulai && $tanggal_selesai) {
                    $query->whereBetween('waktu_submit', [
                        Carbon::parse($tanggal_mulai)->startOfDay(),
                        Carbon::parse($tanggal_selesai)->endOfDay()
                    ]);
                    $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
                } else {
                    $query->whereDate('waktu_submit', Carbon::today());
                    $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                }
                break;
        }
        
        // Clone query untuk statistik
        $statistikQuery = clone $query;
        
        // Hitung data statistik
        $total_pendaftaran = $statistikQuery->count();
        $menunggu = (clone $statistikQuery)->where('status', 'menunggu')->count();
        $dikonfirmasi = (clone $statistikQuery)->where('status', 'dikonfirmasi')->count();
        $ditolak = (clone $statistikQuery)->where('status', 'ditolak')->count();
        
        // Hitung berdasarkan keluhan
        $pemeriksaan_umum = (clone $statistikQuery)->where('keluhan', 'pemeriksaan_umum')->count();
        $lab = (clone $statistikQuery)->where('keluhan', 'lab')->count();
        $radiologi = (clone $statistikQuery)->where('keluhan', 'radiologi')->count();
        
        // Hitung berdasarkan jenis kelamin
        $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
        
        // Ambil semua data untuk PDF (tanpa paginasi)
        $pendaftaran = $query->orderBy('waktu_submit', 'desc')->get();
        
        $data = compact(
            'periode',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_periode',
            'total_pendaftaran',
            'menunggu',
            'dikonfirmasi',
            'ditolak',
            'pemeriksaan_umum',
            'lab',
            'radiologi',
            'laki_laki',
            'perempuan',
            'pendaftaran'
        );
        
        $pdf = Pdf::loadView('admin.laporanklinik.pdf.pendaftaran', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'laporan-pendaftaran-' . str_replace(['/', ' ', '(', ')'], '-', $judul_periode) . '.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Export laporan pemeriksaan umum ke PDF
     */
    public function exportLaporanPemeriksaanUmum(Request $request)
    {
        // Default periode hari ini
        $periode = $request->get('periode', 'hari_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        
        $query = PemeriksaanUmum::query();
        
        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('tgl_transfer', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                break;
                
            case 'bulan_ini':
                $query->whereMonth('tgl_transfer', Carbon::now()->month)
                      ->whereYear('tgl_transfer', Carbon::now()->year);
                $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
                break;
                
            case 'custom':
                if ($tanggal_mulai && $tanggal_selesai) {
                    $query->whereBetween('tgl_transfer', [
                        Carbon::parse($tanggal_mulai)->startOfDay(),
                        Carbon::parse($tanggal_selesai)->endOfDay()
                    ]);
                    $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
                } else {
                    $query->whereDate('tgl_transfer', Carbon::today());
                    $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                }
                break;
        }
        
        // Clone query untuk statistik
        $statistikQuery = clone $query;
        
        // Hitung data statistik berdasarkan status pemeriksaan
        $total_pemeriksaan = $statistikQuery->count();
        $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
        $dikonfirmasi = (clone $statistikQuery)->where('status_pemeriksaan', 'dikonfirmasi')->count();
        $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
        $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
        
        // Hitung berdasarkan jenis kelamin
        $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
        
        // Hitung berdasarkan rujukan
        $dengan_rujukan = (clone $statistikQuery)->whereNotNull('rujukan')
                                                  ->where('rujukan', '!=', '')
                                                  ->count();
        $tanpa_rujukan = $total_pemeriksaan - $dengan_rujukan;
        
        // Hitung berdasarkan is_lpk_sentosa
        $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
        $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
        
        // Ambil semua data untuk PDF (tanpa paginasi)
        $pemeriksaan_umum = $query->orderBy('tgl_transfer', 'desc')
                                  ->orderBy('no_antrian', 'asc')
                                  ->get();
        
        $data = compact(
            'periode',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_periode',
            'total_pemeriksaan',
            'menunggu',
            'dikonfirmasi',
            'sedang_diperiksa',
            'selesai',
            'laki_laki',
            'perempuan',
            'dengan_rujukan',
            'tanpa_rujukan',
            'lpk_sentosa',
            'umum',
            'pemeriksaan_umum'
        );
        
        $pdf = Pdf::loadView('admin.laporanklinik.pdf.pemeriksaan-umum', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'laporan-pemeriksaan-umum-' . str_replace(['/', ' ', '(', ')'], '-', $judul_periode) . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export laporan laboratorium ke PDF
     */
    public function exportLaporanLaboratorium(Request $request)
    {
        // Default periode hari ini
        $periode = $request->get('periode', 'hari_ini');
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        
        $query = \App\Models\Laboratorium::query();
        
        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('tgl_pemeriksaan', Carbon::today());
                $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                break;
                
            case 'bulan_ini':
                $query->whereMonth('tgl_pemeriksaan', Carbon::now()->month)
                      ->whereYear('tgl_pemeriksaan', Carbon::now()->year);
                $judul_periode = 'Bulan Ini (' . Carbon::now()->format('F Y') . ')';
                break;
                
            case 'custom':
                if ($tanggal_mulai && $tanggal_selesai) {
                    $query->whereBetween('tgl_pemeriksaan', [
                        Carbon::parse($tanggal_mulai)->startOfDay(),
                        Carbon::parse($tanggal_selesai)->endOfDay()
                    ]);
                    $judul_periode = Carbon::parse($tanggal_mulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggal_selesai)->format('d/m/Y');
                } else {
                    $query->whereDate('tgl_pemeriksaan', Carbon::today());
                    $judul_periode = 'Hari Ini (' . Carbon::today()->format('d/m/Y') . ')';
                }
                break;
        }
        
        // Clone query untuk statistik
        $statistikQuery = clone $query;
        
        // Hitung data statistik berdasarkan status pemeriksaan
        $total_laboratorium = $statistikQuery->count();
        $menunggu = (clone $statistikQuery)->where('status_pemeriksaan', 'menunggu')->count();
        $sedang_diperiksa = (clone $statistikQuery)->where('status_pemeriksaan', 'sedang_diperiksa')->count();
        $selesai = (clone $statistikQuery)->where('status_pemeriksaan', 'selesai')->count();
        
        // Hitung berdasarkan jenis kelamin
        $laki_laki = (clone $statistikQuery)->where('jenis_kelamin', 'L')->count();
        $perempuan = (clone $statistikQuery)->where('jenis_kelamin', 'P')->count();
        
        // Hitung berdasarkan hasil lab (hanya yang sudah selesai)
        $ada_hasil = (clone $statistikQuery)->whereNotNull('hasil_lab')
                                            ->where('hasil_lab', '!=', '')
                                            ->count();
        $belum_ada_hasil = $total_laboratorium - $ada_hasil;
        
        // Hitung berdasarkan is_lpk_sentosa
        $lpk_sentosa = (clone $statistikQuery)->where('is_lpk_sentosa', true)->count();
        $umum = (clone $statistikQuery)->where('is_lpk_sentosa', false)->count();
        
        // Hitung berdasarkan dokter pemeriksa (top 5)
        $dokter_stats = (clone $statistikQuery)->whereNotNull('dokter_pemeriksa')
                                               ->where('dokter_pemeriksa', '!=', '')
                                               ->selectRaw('dokter_pemeriksa, COUNT(*) as total')
                                               ->groupBy('dokter_pemeriksa')
                                               ->orderBy('total', 'desc')
                                               ->limit(5)
                                               ->get();
        
        // Ambil semua data untuk PDF (tanpa paginasi)
        $laboratorium = $query->orderBy('tgl_pemeriksaan', 'desc')
                              ->orderBy('no_antrian', 'asc')
                              ->get();
        
        $data = compact(
            'periode',
            'tanggal_mulai',
            'tanggal_selesai',
            'judul_periode',
            'total_laboratorium',
            'menunggu',
            'sedang_diperiksa',
            'selesai',
            'laki_laki',
            'perempuan',
            'ada_hasil',
            'belum_ada_hasil',
            'lpk_sentosa',
            'umum',
            'dokter_stats',
            'laboratorium'
        );
        
        $pdf = Pdf::loadView('admin.laporanklinik.pdf.laboratorium', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'laporan-laboratorium-' . str_replace(['/', ' ', '(', ')'], '-', $judul_periode) . '.pdf';
        
        return $pdf->download($filename);
    }
}