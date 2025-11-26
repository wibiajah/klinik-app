<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PemeriksaanUmum;
use App\Models\Laboratorium;
use App\Models\Radiologi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataPasienController extends Controller
{

    /**
     * Halaman index untuk data lengkap pasien
     */
public function index(Request $request)
{
    // Parameter search terpisah
    $nama = $request->get('nama');
    $nik = $request->get('nik');
    $no_rekam_medis = $request->get('no_rekam_medis');
    
    // Parameter lainnya
    $keluhan_filter = $request->get('keluhan');
    $tanggal_dari = $request->get('tanggal_dari');
    $tanggal_sampai = $request->get('tanggal_sampai', Carbon::today()->format('Y-m-d'));
    $per_page = $request->get('per_page', 1000);

    // Query dasar untuk mengambil semua data pasien dengan riwayat lengkap
    $query = Pendaftaran::with([
        'pemeriksaanUmum',
        'laboratorium',
        'radiologi'
    ])
    ->whereIn('id', function($subQuery) {
        $subQuery->selectRaw('MAX(id)')
                 ->from('pendaftaran')
                 ->groupBy('nik');
    })
    ->orderBy('created_at', 'desc');

    // Filter berdasarkan nama
    if ($nama) {
        $query->where('nama', 'like', "%{$nama}%");
    }

    // Filter berdasarkan NIK
    if ($nik) {
        $query->where('nik', 'like', "%{$nik}%");
    }

    // Filter berdasarkan No Rekam Medis
    if ($no_rekam_medis) {
        $query->where('no_rekam_medis', 'like', "%{$no_rekam_medis}%");
    }

    // Filter berdasarkan keluhan
    if ($keluhan_filter) {
        $query->where('keluhan', $keluhan_filter);
    }

    // Filter berdasarkan tanggal
    if ($tanggal_dari) {
        $query->whereDate('tgl_pendaftaran', '>=', $tanggal_dari);
    }
    if ($tanggal_sampai) {
        $query->whereDate('tgl_pendaftaran', '<=', $tanggal_sampai);
    }

    $dataPasien = $query->paginate($per_page);

    // Proses setiap data untuk menambahkan informasi lengkap
    foreach ($dataPasien as $pasien) {
        $pasien = $this->processDataPasien($pasien);
        
        // TAMBAHAN: Hitung total kunjungan berdasarkan NIK
        $pasien->total_kunjungan_nik = Pendaftaran::where('nik', $pasien->nik)->count();
    }

    // Ambil statistik umum
    $statistics = $this->getStatistics($tanggal_dari, $tanggal_sampai);

    // Ambil riwayat kunjungan berdasarkan NIK untuk dropdown
    $riwayatKunjungan = $this->getRiwayatKunjunganByNik();

    return view('admin.data-pasien.index', compact(
        'dataPasien', 
        'nama',           // Tambahkan ini
        'nik',            // Tambahkan ini  
        'no_rekam_medis', // Tambahkan ini
        'keluhan_filter', 
        'tanggal_dari', 
        'tanggal_sampai',
        'per_page',
        'statistics',
        'riwayatKunjungan'
    ));
}

    /**
     * Detail lengkap pasien berdasarkan NIK
     */
    public function detailByNik($nik)
    {
        // Ambil semua riwayat kunjungan berdasarkan NIK
        $riwayatKunjungan = Pendaftaran::with([
            'pemeriksaanUmum',
            'laboratorium', 
            'radiologi'
        ])
        ->where('nik', $nik)
        ->orderBy('tgl_pendaftaran', 'desc')
        ->get();

        if ($riwayatKunjungan->isEmpty()) {
            abort(404, 'Data pasien tidak ditemukan');
        }

        // Proses setiap kunjungan
        foreach ($riwayatKunjungan as $kunjungan) {
            $kunjungan = $this->processDataPasien($kunjungan);
        }

        // Ambil data identitas pasien (dari kunjungan terbaru)
        $identitasPasien = $riwayatKunjungan->first();

        // Statistik kunjungan pasien ini
        $statistikPasien = [
            'total_kunjungan' => $riwayatKunjungan->count(),
            'pemeriksaan_umum' => $riwayatKunjungan->where('keluhan', 'pemeriksaan_umum')->count(),
            'laboratorium' => $riwayatKunjungan->where('keluhan', 'lab')->count(),
            'radiologi' => $riwayatKunjungan->where('keluhan', 'radiologi')->count(),
            'kunjungan_pertama' => $riwayatKunjungan->last()->tgl_pendaftaran ?? null,
            'kunjungan_terakhir' => $riwayatKunjungan->first()->tgl_pendaftaran ?? null,
        ];

return view('admin.data-pasien.detail-kunjungan', compact(
    'riwayatKunjungan',
    'identitasPasien', 
    'statistikPasien'
));
    }

    /**
     * Detail spesifik satu kunjungan
     */
   public function detailKunjungan($id)
{
    $kunjungan = Pendaftaran::with([
        'pemeriksaanUmum',
        'laboratorium',
        'radiologi'
    ])->findOrFail($id);

    $kunjungan = $this->processDataPasien($kunjungan);

    // Ambil riwayat kunjungan lain dengan NIK yang sama
    $riwayatLain = Pendaftaran::where('nik', $kunjungan->nik)
                             ->where('id', '!=', $id)
                             ->orderBy('tgl_pendaftaran', 'desc')
                             ->limit(5)
                             ->get();

    return view('admin.data-pasien.detail-satu-kunjungan', compact('kunjungan', 'riwayatLain'));
}

    /**
     * Laporan rekap data pasien
     */
    public function laporan(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        // Data rekap bulanan
        $rekapBulanan = [
            'total_kunjungan' => Pendaftaran::whereMonth('tgl_pendaftaran', $bulan)
                                           ->whereYear('tgl_pendaftaran', $tahun)
                                           ->count(),
            'pemeriksaan_umum' => Pendaftaran::whereMonth('tgl_pendaftaran', $bulan)
                                            ->whereYear('tgl_pendaftaran', $tahun)
                                            ->where('keluhan', 'pemeriksaan_umum')
                                            ->count(),
            'laboratorium' => Pendaftaran::whereMonth('tgl_pendaftaran', $bulan)
                                        ->whereYear('tgl_pendaftaran', $tahun)
                                        ->where('keluhan', 'lab')
                                        ->count(),
            'radiologi' => Pendaftaran::whereMonth('tgl_pendaftaran', $bulan)
                                     ->whereYear('tgl_pendaftaran', $tahun)
                                     ->where('keluhan', 'radiologi')
                                     ->count(),
        ];

        // Data harian dalam bulan
        $dataHarian = Pendaftaran::selectRaw('DATE(tgl_pendaftaran) as tanggal, keluhan, COUNT(*) as jumlah')
                                ->whereMonth('tgl_pendaftaran', $bulan)
                                ->whereYear('tgl_pendaftaran', $tahun)
                                ->groupBy('tanggal', 'keluhan')
                                ->orderBy('tanggal')
                                ->get()
                                ->groupBy('tanggal');

        // Top 10 pasien dengan kunjungan terbanyak
        $pasienTerbanyak = Pendaftaran::selectRaw('nik, nama, COUNT(*) as total_kunjungan')
                                     ->whereMonth('tgl_pendaftaran', $bulan)
                                     ->whereYear('tgl_pendaftaran', $tahun)
                                     ->groupBy('nik', 'nama')
                                     ->orderByDesc('total_kunjungan')
                                     ->limit(10)
                                     ->get();

        return view('admin.data-pasien.laporan', compact(
            'rekapBulanan',
            'dataHarian', 
            'pasienTerbanyak',
            'bulan',
            'tahun'
        ));
    }

    /**
     * Export data ke Excel/PDF
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel'); // excel atau pdf
        $filter = $request->only(['search', 'keluhan', 'tanggal_dari', 'tanggal_sampai']);
        
        // Implementasi export akan dibuat terpisah dengan package seperti Laravel Excel
        // Untuk sekarang return response JSON
        
        return response()->json([
            'message' => 'Export akan diimplementasikan',
            'format' => $format,
            'filter' => $filter
        ]);
    }

    /**
     * Proses data pasien untuk menambah informasi lengkap
     */
    private function processDataPasien($pasien)
    {
        // Status transfer
        $pasien->is_transferred_pemeriksaan_umum = $pasien->pemeriksaanUmum()->exists();
        $pasien->is_transferred_laboratorium = $pasien->laboratorium()->exists();
        $pasien->is_transferred_radiologi = $pasien->radiologi()->exists();

        // Timeline proses
        $pasien->timeline = $this->createTimeline($pasien);

        // Status lengkap
        $pasien->status_lengkap = $this->getStatusLengkap($pasien);

        // Hasil pemeriksaan
        $pasien->hasil_pemeriksaan = $this->getHasilPemeriksaan($pasien);

        return $pasien;
    }

    /**
     * Buat timeline proses pasien
     */
   private function createTimeline($pasien)
{
    $timeline = [];

    // 1. Pendaftaran
    $timeline[] = [
        'step' => 'Pendaftaran',
        'tanggal' => $pasien->tgl_pendaftaran,
        'waktu' => $pasien->created_at, // Gunakan created_at sebagai waktu submit
        'status' => $pasien->status,
        'keterangan' => "Keluhan: " . ucfirst(str_replace('_', ' ', $pasien->keluhan))
    ];

    // 2. Konfirmasi
    if ($pasien->status == 'dikonfirmasi') {
        $timeline[] = [
            'step' => 'Dikonfirmasi',
            'tanggal' => $pasien->updated_at->format('Y-m-d'),
            'waktu' => $pasien->updated_at,
            'status' => 'selesai',
            'keterangan' => "No. Rekam Medis: " . $pasien->no_rekam_medis
        ];
    }

    // 3. Transfer ke layanan
    if ($pasien->keluhan == 'pemeriksaan_umum' && $pasien->pemeriksaanUmum) {
        $pemeriksaan = $pasien->pemeriksaanUmum;
        
        $timeline[] = [
            'step' => 'Transfer ke Pemeriksaan Umum',
            'tanggal' => $pemeriksaan->tgl_transfer ?? $pemeriksaan->created_at->format('Y-m-d'),
            'waktu' => $pemeriksaan->created_at,
            'status' => 'selesai',
            'keterangan' => "Status: " . ucfirst(str_replace('_', ' ', $pemeriksaan->status_pemeriksaan))
        ];

        // Timeline pemeriksaan umum
        $timeline = array_merge($timeline, $this->getTimelinePemeriksaanUmum($pemeriksaan));
    }

    if ($pasien->keluhan == 'lab' && $pasien->laboratorium) {
        $lab = $pasien->laboratorium;
        
        $timeline[] = [
            'step' => 'Transfer ke Laboratorium',
            'tanggal' => $lab->tgl_pemeriksaan ?? $lab->created_at->format('Y-m-d'),
            'waktu' => $lab->created_at,
            'status' => 'selesai',
            'keterangan' => "Status: " . ucfirst(str_replace('_', ' ', $lab->status_pemeriksaan))
        ];

        // Timeline laboratorium
        $timeline = array_merge($timeline, $this->getTimelineLaboratorium($lab));
    }

    if ($pasien->keluhan == 'radiologi' && $pasien->radiologi) {
        $radiologi = $pasien->radiologi;
        
        $timeline[] = [
            'step' => 'Transfer ke Radiologi',
            'tanggal' => $radiologi->tgl_pemeriksaan ?? $radiologi->created_at->format('Y-m-d'),
            'waktu' => $radiologi->created_at,
            'status' => 'selesai',
            'keterangan' => "Status: " . ucfirst(str_replace('_', ' ', $radiologi->status_pemeriksaan))
        ];

        // Timeline radiologi
        $timeline = array_merge($timeline, $this->getTimelineRadiologi($radiologi));
    }

    return collect($timeline)->sortBy('waktu')->values()->all();
}

    /**
     * Timeline untuk pemeriksaan umum
     */
    private function getTimelinePemeriksaanUmum($pemeriksaan)
{
    $timeline = [];

    if ($pemeriksaan->waktu_konfirmasi) {
        $waktu_konfirmasi = is_string($pemeriksaan->waktu_konfirmasi) 
            ? Carbon::parse($pemeriksaan->waktu_konfirmasi) 
            : $pemeriksaan->waktu_konfirmasi;
            
        $timeline[] = [
            'step' => 'Konfirmasi Pemeriksaan',
            'tanggal' => $waktu_konfirmasi->format('Y-m-d'),
            'waktu' => $waktu_konfirmasi,
            'status' => 'selesai',
            'keterangan' => "No. Antrian: " . $pemeriksaan->no_antrian
        ];
    }

    if ($pemeriksaan->waktu_mulai_periksa) {
        $waktu_mulai = is_string($pemeriksaan->waktu_mulai_periksa) 
            ? Carbon::parse($pemeriksaan->waktu_mulai_periksa) 
            : $pemeriksaan->waktu_mulai_periksa;
            
        $timeline[] = [
            'step' => 'Mulai Pemeriksaan',
            'tanggal' => $waktu_mulai->format('Y-m-d'),
            'waktu' => $waktu_mulai,
            'status' => 'selesai',
            'keterangan' => 'Pemeriksaan dimulai'
        ];
    }

    if ($pemeriksaan->waktu_selesai_periksa) {
        $waktu_selesai = is_string($pemeriksaan->waktu_selesai_periksa) 
            ? Carbon::parse($pemeriksaan->waktu_selesai_periksa) 
            : $pemeriksaan->waktu_selesai_periksa;
            
        $timeline[] = [
            'step' => 'Selesai Pemeriksaan',
            'tanggal' => $waktu_selesai->format('Y-m-d'),
            'waktu' => $waktu_selesai,
            'status' => 'selesai',
            'keterangan' => 'Pemeriksaan selesai'
        ];
    }

    return $timeline;
}

    /**
     * Timeline untuk laboratorium
     */
    private function getTimelineLaboratorium($lab)
{
    $timeline = [];

    if ($lab->no_antrian) {
        $timeline[] = [
            'step' => 'Set Antrian Lab',
            'tanggal' => $lab->updated_at->format('Y-m-d'),
            'waktu' => $lab->updated_at,
            'status' => 'selesai',
            'keterangan' => "No. Antrian: " . $lab->no_antrian
        ];
    }

    if ($lab->status_pemeriksaan == 'sedang_diperiksa') {
        $timeline[] = [
            'step' => 'Pemeriksaan Lab Dimulai',
            'tanggal' => $lab->updated_at->format('Y-m-d'),
            'waktu' => $lab->updated_at,
            'status' => 'selesai',
            'keterangan' => 'Sedang dalam pemeriksaan'
        ];
    }

    if ($lab->status_pemeriksaan == 'selesai' && $lab->hasil_lab) {
        $timeline[] = [
            'step' => 'Hasil Lab Selesai',
            'tanggal' => $lab->updated_at->format('Y-m-d'),
            'waktu' => $lab->updated_at,
            'status' => 'selesai',
            'keterangan' => "Dokter: " . ($lab->dokter_pemeriksa ?? 'Belum ditentukan')
        ];
    }

    return $timeline;
}

    /**
     * Timeline untuk radiologi
     */
   private function getTimelineRadiologi($radiologi)
{
    $timeline = [];

    if ($radiologi->no_antrian) {
        $timeline[] = [
            'step' => 'Set Antrian Radiologi',
            'tanggal' => $radiologi->updated_at->format('Y-m-d'),
            'waktu' => $radiologi->updated_at,
            'status' => 'selesai',
            'keterangan' => "No. Antrian: " . $radiologi->no_antrian
        ];
    }

    if ($radiologi->status_pemeriksaan == 'sedang_diperiksa') {
        $timeline[] = [
            'step' => 'Pemeriksaan Radiologi Dimulai',
            'tanggal' => $radiologi->updated_at->format('Y-m-d'),
            'waktu' => $radiologi->updated_at,
            'status' => 'selesai',
            'keterangan' => 'Sedang dalam pemeriksaan'
        ];
    }

    if ($radiologi->status_pemeriksaan == 'selesai' && $radiologi->hasil_radiologi) {
        $timeline[] = [
            'step' => 'Hasil Radiologi Selesai',
            'tanggal' => $radiologi->updated_at->format('Y-m-d'),
            'waktu' => $radiologi->updated_at,
            'status' => 'selesai',
            'keterangan' => "Jenis: " . ucfirst($radiologi->jenis_radiologi ?? '-') . " | Dokter: " . ($radiologi->dokter_radiologi ?? 'Belum ditentukan')
        ];
    }

    return $timeline;
}

    /**
     * Get status lengkap pasien
     */
    private function getStatusLengkap($pasien)
    {
        if ($pasien->status == 'ditolak') {
            return ['status' => 'ditolak', 'keterangan' => 'Pendaftaran ditolak'];
        }

        if ($pasien->status == 'menunggu') {
            return ['status' => 'menunggu', 'keterangan' => 'Menunggu konfirmasi'];
        }

        // Cek berdasarkan keluhan
        switch ($pasien->keluhan) {
            case 'pemeriksaan_umum':
                return $this->getStatusPemeriksaanUmum($pasien);
            case 'lab':
                return $this->getStatusLaboratorium($pasien);
            case 'radiologi':
                return $this->getStatusRadiologi($pasien);
            default:
                return ['status' => 'unknown', 'keterangan' => 'Status tidak diketahui'];
        }
    }

    /**
     * Status pemeriksaan umum
     */
    private function getStatusPemeriksaanUmum($pasien)
    {
        if (!$pasien->pemeriksaanUmum) {
            return ['status' => 'belum_transfer', 'keterangan' => 'Belum ditransfer ke pemeriksaan umum'];
        }

        $pemeriksaan = $pasien->pemeriksaanUmum;
        
        switch ($pemeriksaan->status_pemeriksaan) {
            case 'menunggu':
                return ['status' => 'menunggu_konfirmasi', 'keterangan' => 'Menunggu konfirmasi pemeriksaan'];
            case 'dikonfirmasi':
                return ['status' => 'siap_periksa', 'keterangan' => 'Siap diperiksa - Antrian: ' . $pemeriksaan->no_antrian];
            case 'sedang_diperiksa':
                return ['status' => 'sedang_diperiksa', 'keterangan' => 'Sedang dalam pemeriksaan'];
            case 'selesai':
                return ['status' => 'selesai', 'keterangan' => 'Pemeriksaan selesai'];
            default:
                return ['status' => 'unknown', 'keterangan' => 'Status tidak diketahui'];
        }
    }

    /**
     * Status laboratorium
     */
    private function getStatusLaboratorium($pasien)
    {
        if (!$pasien->laboratorium) {
            return ['status' => 'belum_transfer', 'keterangan' => 'Belum ditransfer ke laboratorium'];
        }

        $lab = $pasien->laboratorium;
        
        if ($lab->status_pemeriksaan == 'menunggu' && !$lab->no_antrian) {
            return ['status' => 'menunggu_antrian', 'keterangan' => 'Menunggu penetapan antrian'];
        }

        if ($lab->status_pemeriksaan == 'menunggu' && $lab->no_antrian) {
            return ['status' => 'siap_periksa', 'keterangan' => 'Siap diperiksa - Antrian: ' . $lab->no_antrian];
        }

        switch ($lab->status_pemeriksaan) {
            case 'sedang_diperiksa':
                return ['status' => 'sedang_diperiksa', 'keterangan' => 'Sedang dalam pemeriksaan'];
            case 'selesai':
                return ['status' => 'selesai', 'keterangan' => 'Pemeriksaan selesai'];
            default:
                return ['status' => 'unknown', 'keterangan' => 'Status tidak diketahui'];
        }
    }

    /**
     * Status radiologi
     */
    private function getStatusRadiologi($pasien)
    {
        if (!$pasien->radiologi) {
            return ['status' => 'belum_transfer', 'keterangan' => 'Belum ditransfer ke radiologi'];
        }

        $radiologi = $pasien->radiologi;
        
        if ($radiologi->status_pemeriksaan == 'menunggu' && !$radiologi->no_antrian) {
            return ['status' => 'menunggu_antrian', 'keterangan' => 'Menunggu penetapan antrian'];
        }

        if ($radiologi->status_pemeriksaan == 'menunggu' && $radiologi->no_antrian) {
            return ['status' => 'siap_periksa', 'keterangan' => 'Siap diperiksa - Antrian: ' . $radiologi->no_antrian];
        }

        switch ($radiologi->status_pemeriksaan) {
            case 'sedang_diperiksa':
                return ['status' => 'sedang_diperiksa', 'keterangan' => 'Sedang dalam pemeriksaan'];
            case 'selesai':
                return ['status' => 'selesai', 'keterangan' => 'Pemeriksaan selesai'];
            default:
                return ['status' => 'unknown', 'keterangan' => 'Status tidak diketahui'];
        }
    }

    /**
     * Get hasil pemeriksaan
     */
    private function getHasilPemeriksaan($pasien)
    {
        $hasil = [];

        switch ($pasien->keluhan) {
            case 'pemeriksaan_umum':
                if ($pasien->pemeriksaanUmum && $pasien->pemeriksaanUmum->status_pemeriksaan == 'selesai') {
                    $hasil = [
                        'diagnosis' => $pasien->pemeriksaanUmum->diagnosis_sementara,
                        'obat' => $pasien->pemeriksaanUmum->obat_diberikan,
                        'anjuran' => $pasien->pemeriksaanUmum->anjuran_instruksi,
                        'rujukan' => $pasien->pemeriksaanUmum->rujukan,
                    ];
                }
                break;

            case 'lab':
                if ($pasien->laboratorium && $pasien->laboratorium->status_pemeriksaan == 'selesai') {
                    $hasil = [
                        'hasil_lab' => $pasien->laboratorium->hasil_lab,
                        'dokter_pemeriksa' => $pasien->laboratorium->dokter_pemeriksa,
                        'catatan' => $pasien->laboratorium->catatan_lab,
                    ];
                }
                break;

            case 'radiologi':
                if ($pasien->radiologi && $pasien->radiologi->status_pemeriksaan == 'selesai') {
                    $hasil = [
                        'jenis_radiologi' => $pasien->radiologi->jenis_radiologi,
                        'hasil_radiologi' => $pasien->radiologi->hasil_radiologi,
                        'dokter_radiologi' => $pasien->radiologi->dokter_radiologi,
                        'teknisi_radiologi' => $pasien->radiologi->teknisi_radiologi,
                        'catatan' => $pasien->radiologi->catatan_radiologi,
                    ];
                }
                break;
        }

        return $hasil;
    }

    /**
     * Get statistik umum
     */
    private function getStatistics($tanggal_dari = null, $tanggal_sampai = null)
    {
        $query = Pendaftaran::query();

        if ($tanggal_dari) {
            $query->whereDate('tgl_pendaftaran', '>=', $tanggal_dari);
        }
        if ($tanggal_sampai) {
            $query->whereDate('tgl_pendaftaran', '<=', $tanggal_sampai);
        }

        return [
            'total_kunjungan' => $query->count(),
            'pemeriksaan_umum' => (clone $query)->where('keluhan', 'pemeriksaan_umum')->count(),
            'laboratorium' => (clone $query)->where('keluhan', 'lab')->count(),
            'radiologi' => (clone $query)->where('keluhan', 'radiologi')->count(),
            'menunggu' => (clone $query)->where('status', 'menunggu')->count(),
            'dikonfirmasi' => (clone $query)->where('status', 'dikonfirmasi')->count(),
            'ditolak' => (clone $query)->where('status', 'ditolak')->count(),
        ];
    }

    /**
     * Get riwayat kunjungan berdasarkan NIK (untuk dropdown)
     */
    private function getRiwayatKunjunganByNik()
    {
        return Pendaftaran::selectRaw('nik, nama, COUNT(*) as total_kunjungan')
                         ->groupBy('nik', 'nama')
                         ->orderByDesc('total_kunjungan')
                         ->limit(50)
                         ->get();
    }

    /**
 * Halaman untuk menampilkan semua data pasien dengan jumlah kunjungan
 */
public function kunjunganPasien(Request $request)
{
    $search = $request->get('search');
    $per_page = $request->get('per_page', 50);
    
    // Query untuk mengambil data pasien unik dengan jumlah kunjungan
    $query = Pendaftaran::selectRaw('
            nik,
            MAX(nama) as nama,
            MAX(jenis_kelamin) as jenis_kelamin,
            MAX(tgl_lahir) as tgl_lahir,
            MAX(no_hp) as no_hp,
            MAX(email) as email,
            MAX(alamat_lengkap) as alamat_lengkap,
            MAX(no_rekam_medis) as no_rekam_medis,
            COUNT(*) as total_kunjungan,
            MAX(tgl_pendaftaran) as kunjungan_terakhir,
            MIN(tgl_pendaftaran) as kunjungan_pertama
        ')
        ->whereNotNull('nik')
        ->groupBy('nik')
        ->orderBy('total_kunjungan', 'desc');
    
    // Filter pencarian
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nik', 'like', "%{$search}%")
              ->orWhere('no_rekam_medis', 'like', "%{$search}%");
        });
    }
    
    $dataPasien = $query->paginate($per_page);
    
    // TAMBAHKAN INI: Convert string ke Carbon object
    $dataPasien->getCollection()->transform(function ($pasien) {
        $pasien->kunjungan_pertama = $pasien->kunjungan_pertama ? \Carbon\Carbon::parse($pasien->kunjungan_pertama) : null;
        $pasien->kunjungan_terakhir = $pasien->kunjungan_terakhir ? \Carbon\Carbon::parse($pasien->kunjungan_terakhir) : null;
        return $pasien;
    });
    
    // Statistik ringkas
    $totalPasien = Pendaftaran::distinct('nik')->count('nik');
    $totalKunjungan = Pendaftaran::count();
    $rataRataKunjungan = $totalPasien > 0 ? round($totalKunjungan / $totalPasien, 1) : 0;
    
    return view('admin.data-pasien.kunjunganpasien', compact(
        'dataPasien',
        'search',
        'per_page',
        'totalPasien',
        'totalKunjungan',
        'rataRataKunjungan'
    ));
}
}