<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PemeriksaanUmum;
use App\Models\Laboratorium;
use App\Models\Radiologi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Dashboard admin - menampilkan statistik lengkap
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Statistik lengkap untuk dashboard
        $statistics = [
            // 1. Total data pasien dari semua model
            'total_pasien' => $this->getTotalPasien(),
            
            // 2. Pendaftaran hari ini
            'pendaftaran_hari_ini' => Pendaftaran::whereDate('tgl_pendaftaran', Carbon::today())->count(),
            
            // 3. Pasien di pemeriksaan umum  
            'pemeriksaan_umum' => PemeriksaanUmum::count(),
            
            // 4. Pasien di laboratorium
            'laboratorium' => Laboratorium::count(),
            
            // 5. Pasien di radiologi
            'radiologi' => Radiologi::count(),
            
            // 6. Pasien dikonfirmasi
            'dikonfirmasi' => Pendaftaran::where('status', 'dikonfirmasi')->count(),
            
            // 7. Pasien ditolak
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
            
            // 8. Total pasien berobat (dari semua model pemeriksaan)
            'total_berobat' => $this->getTotalPasienBerobat(),
            
            // Statistik tambahan untuk kompatibilitas dengan view yang ada
            'total_hari_ini' => Pendaftaran::byTanggalPendaftaran(Carbon::today()->format('Y-m-d'))->count(),
            'menunggu' => Pendaftaran::byStatus('menunggu')->count(),
            
            // TAMBAHAN: Statistik total pendaftaran untuk chart
            'total_pendaftaran_hari_ini' => $this->getTotalPendaftaranByDate(Carbon::today()),
            'total_pendaftaran_kemarin' => $this->getTotalPendaftaranByDate(Carbon::yesterday()),
            'total_pendaftaran_seminggu' => $this->getTotalPendaftaranByPeriod(7),
        ];

        // TAMBAHAN: Data untuk dashboard yang diperkaya
        $dashboardData = [
            // Statistik pemeriksaan hari ini per layanan
            'pemeriksaan_hari_ini' => $this->getPemeriksaanHariIni(),
            
            // Statistik status pemeriksaan
            'status_pemeriksaan' => $this->getStatusPemeriksaan(),
            
            // Pasien dengan kunjungan terbanyak (top 5)
            'top_pasien' => $this->getTopPasien(),
            
            // Grafik kunjungan 7 hari terakhir
            'grafik_mingguan' => $this->getGrafikMingguan(),
            
            // Statistik bulanan
            'statistik_bulanan' => $this->getStatistikBulanan(),
            
            // Antrian terpanjang saat ini
            'antrian_terpanjang' => $this->getAntrianTerpanjang(),
            
            // Pasien selesai pemeriksaan hari ini
            'selesai_hari_ini' => $this->getSelesaiHariIni(),
            
            // TAMBAHAN: Data total pendaftaran mingguan untuk chart
            'statistik_total_pendaftaran_mingguan' => $this->getStatistikTotalPendaftaranMingguan(),

                'pendaftaran_7_hari' => $this->getPendaftaran7Hari(),
        ];

        return view('admin.dashboard', compact('user', 'statistics', 'dashboardData'));
    }
private function getPendaftaran7Hari()
{
    $data = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $data[] = [
            'tanggal' => $date->format('Y-m-d'),
            'tanggal_format' => $date->format('d/m'),
            'jumlah' => Pendaftaran::whereDate('tgl_pendaftaran', $date)->count()
        ];
    }
    return $data;
}
    /**
     * TAMBAHAN: Method untuk mendapatkan total pendaftaran berdasarkan tanggal
     */
    private function getTotalPendaftaranByDate($date)
    {
        return Pendaftaran::whereDate('tgl_pendaftaran', $date)->count();
    }

    /**
     * TAMBAHAN: Method untuk mendapatkan total pendaftaran berdasarkan periode (hari)
     */
    private function getTotalPendaftaranByPeriod($days)
    {
        $startDate = Carbon::today()->subDays($days - 1);
        $endDate = Carbon::today();
        
        return Pendaftaran::whereBetween('tgl_pendaftaran', [$startDate, $endDate])->count();
    }

    /**
     * TAMBAHAN: Statistik total pendaftaran mingguan untuk chart
     */
    private function getStatistikTotalPendaftaranMingguan()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $data[] = [
                'tanggal' => $date->format('d/m'),
                'tanggal_full' => $date->format('Y-m-d'),
                'total' => Pendaftaran::whereDate('tgl_pendaftaran', $date)->count()
            ];
        }
        return $data;
    }

    /**
     * TAMBAHAN: Method untuk mendapatkan statistik total pendaftaran (AJAX)
     */
    public function getTotalPendaftaranStatistics()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $weekAgo = Carbon::today()->subDays(6);
        
        $statistics = [
            'hari_ini' => Pendaftaran::whereDate('tgl_pendaftaran', $today)->count(),
            'kemarin' => Pendaftaran::whereDate('tgl_pendaftaran', $yesterday)->count(),
            'seminggu_terakhir' => Pendaftaran::whereBetween('tgl_pendaftaran', [$weekAgo, $today])->count(),
            'mingguan_detail' => $this->getStatistikTotalPendaftaranMingguan(),
        ];

        return response()->json($statistics);
    }

    /**
     * Hitung total pasien dari semua database/model
     */
    private function getTotalPasien()
    {
        // Menggunakan NIK sebagai identitas unik pasien
        // Menghitung jumlah NIK unik dari semua tabel
        
        $nikPendaftaran = Pendaftaran::distinct()->pluck('nik');
        $nikPemeriksaan = PemeriksaanUmum::distinct()->pluck('nik');
        $nikLaboratorium = Laboratorium::distinct()->pluck('nik');
        $nikRadiologi = Radiologi::distinct()->pluck('nik');

        // Gabungkan semua NIK dan ambil yang unik
        $allNik = collect()
            ->merge($nikPendaftaran)
            ->merge($nikPemeriksaan)
            ->merge($nikLaboratorium)
            ->merge($nikRadiologi)
            ->unique()
            ->filter(); // Hapus nilai null/kosong

        return $allNik->count();
    }

    /**
     * Hitung total pasien berobat dari semua model pemeriksaan
     */
    private function getTotalPasienBerobat()
    {
        // Hitung pasien yang sudah berobat (status selesai atau sedang diperiksa)
        $pemeriksaanUmum = PemeriksaanUmum::whereIn('status_pemeriksaan', ['selesai', 'sedang_diperiksa'])->count();
        $laboratorium = Laboratorium::whereIn('status_pemeriksaan', ['selesai', 'sedang_diperiksa'])->count();
        $radiologi = Radiologi::whereIn('status_pemeriksaan', ['selesai', 'sedang_diperiksa'])->count();

        return $pemeriksaanUmum + $laboratorium + $radiologi;
    }

    /**
     * TAMBAHAN: Statistik pemeriksaan hari ini per layanan
     */
    private function getPemeriksaanHariIni()
    {
        $today = Carbon::today();
        
        return [
            'pemeriksaan_umum' => [
                'total' => PemeriksaanUmum::whereDate('tgl_transfer', $today)->count(),
                'selesai' => PemeriksaanUmum::whereDate('tgl_transfer', $today)
                                           ->where('status_pemeriksaan', 'selesai')->count(),
                'sedang_proses' => PemeriksaanUmum::whereDate('tgl_transfer', $today)
                                                 ->where('status_pemeriksaan', 'sedang_diperiksa')->count(),
            ],
            'laboratorium' => [
                'total' => Laboratorium::whereDate('created_at', $today)->count(),
                'selesai' => Laboratorium::whereDate('created_at', $today)
                                        ->where('status_pemeriksaan', 'selesai')->count(),
                'sedang_proses' => Laboratorium::whereDate('created_at', $today)
                                               ->where('status_pemeriksaan', 'sedang_diperiksa')->count(),
            ],
            'radiologi' => [
                'total' => Radiologi::whereDate('tgl_pemeriksaan', $today)->count(),
                'selesai' => Radiologi::whereDate('tgl_pemeriksaan', $today)
                                     ->where('status_pemeriksaan', 'selesai')->count(),
                'sedang_proses' => Radiologi::whereDate('tgl_pemeriksaan', $today)
                                           ->where('status_pemeriksaan', 'sedang_diperiksa')->count(),
            ]
        ];
    }

    /**
     * TAMBAHAN: Status pemeriksaan keseluruhan
     */
    private function getStatusPemeriksaan()
    {
        return [
            'menunggu' => [
                'pemeriksaan_umum' => PemeriksaanUmum::where('status_pemeriksaan', 'menunggu')->count(),
                'laboratorium' => Laboratorium::where('status_pemeriksaan', 'menunggu')->count(),
                'radiologi' => Radiologi::where('status_pemeriksaan', 'menunggu')->count(),
            ],
            'sedang_diperiksa' => [
                'pemeriksaan_umum' => PemeriksaanUmum::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
                'laboratorium' => Laboratorium::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
                'radiologi' => Radiologi::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
            ],
            'selesai' => [
                'pemeriksaan_umum' => PemeriksaanUmum::where('status_pemeriksaan', 'selesai')->count(),
                'laboratorium' => Laboratorium::where('status_pemeriksaan', 'selesai')->count(),
                'radiologi' => Radiologi::where('status_pemeriksaan', 'selesai')->count(),
            ]
        ];
    }

    /**
     * TAMBAHAN: Pasien dengan kunjungan terbanyak (FIXED VERSION)
     */
    private function getTopPasien()
    {
        // SOLUSI 1: Menggunakan approach yang sama dengan DataPasienController
        $latestRecords = Pendaftaran::whereIn('id', function($subQuery) {
            $subQuery->selectRaw('MAX(id)')
                     ->from('pendaftaran')
                     ->groupBy('nik');
        })
        ->select('nik', 'nama')
        ->get();
        
        // Hitung total kunjungan untuk setiap NIK
        $result = collect();
        
        foreach ($latestRecords as $record) {
            $totalKunjungan = Pendaftaran::where('nik', $record->nik)->count();
            
            $result->push((object) [
                'nik' => $record->nik,
                'nama' => $record->nama, // Ini akan mengambil nama dari record terbaru (berdasarkan ID tertinggi)
                'total_kunjungan' => $totalKunjungan
            ]);
        }
        
        return $result->sortByDesc('total_kunjungan')->take(5)->values();
    }

    /**
     * TAMBAHAN: Grafik kunjungan 7 hari terakhir
     */
    private function getGrafikMingguan()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $data[] = [
                'tanggal' => $date->format('d/m'),
                'tanggal_full' => $date->format('Y-m-d'),
                'pemeriksaan_umum' => Pendaftaran::whereDate('tgl_pendaftaran', $date)
                                                ->where('keluhan', 'pemeriksaan_umum')->count(),
                'laboratorium' => Pendaftaran::whereDate('tgl_pendaftaran', $date)
                                            ->where('keluhan', 'lab')->count(),
                'radiologi' => Pendaftaran::whereDate('tgl_pendaftaran', $date)
                                         ->where('keluhan', 'radiologi')->count(),
                'total' => Pendaftaran::whereDate('tgl_pendaftaran', $date)->count()
            ];
        }
        return $data;
    }

    /**
     * TAMBAHAN: Statistik bulanan
     */
    private function getStatistikBulanan()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        return [
            'total_kunjungan' => Pendaftaran::whereMonth('tgl_pendaftaran', $currentMonth)
                                          ->whereYear('tgl_pendaftaran', $currentYear)
                                          ->count(),
            'pemeriksaan_umum' => Pendaftaran::whereMonth('tgl_pendaftaran', $currentMonth)
                                            ->whereYear('tgl_pendaftaran', $currentYear)
                                            ->where('keluhan', 'pemeriksaan_umum')
                                            ->count(),
            'laboratorium' => Pendaftaran::whereMonth('tgl_pendaftaran', $currentMonth)
                                        ->whereYear('tgl_pendaftaran', $currentYear)
                                        ->where('keluhan', 'lab')
                                        ->count(),
            'radiologi' => Pendaftaran::whereMonth('tgl_pendaftaran', $currentYear)
                                     ->whereYear('tgl_pendaftaran', $currentYear)
                                     ->where('keluhan', 'radiologi')
                                     ->count(),
        ];
    }

    /**
     * TAMBAHAN: Antrian terpanjang saat ini
     */
    private function getAntrianTerpanjang()
    {
        return [
            'pemeriksaan_umum' => PemeriksaanUmum::where('status_pemeriksaan', 'menunggu')
                                                ->whereNotNull('no_antrian')
                                                ->count(),
            'laboratorium' => Laboratorium::where('status_pemeriksaan', 'menunggu')
                                         ->whereNotNull('no_antrian')
                                         ->count(),
            'radiologi' => Radiologi::where('status_pemeriksaan', 'menunggu')
                                   ->whereNotNull('no_antrian')
                                   ->count(),
        ];
    }

    /**
     * TAMBAHAN: Pasien selesai pemeriksaan hari ini
     */
    private function getSelesaiHariIni()
    {
        $today = Carbon::today();
        
        return [
            'pemeriksaan_umum' => PemeriksaanUmum::whereDate('updated_at', $today)
                                                ->where('status_pemeriksaan', 'selesai')
                                                ->count(),
            'laboratorium' => Laboratorium::whereDate('updated_at', $today)
                                         ->where('status_pemeriksaan', 'selesai')
                                         ->count(),
            'radiologi' => Radiologi::whereDate('updated_at', $today)
                                   ->where('status_pemeriksaan', 'selesai')
                                   ->count(),
        ];
    }

    /**
     * Method untuk mendapatkan statistik detail (bisa dipanggil via AJAX)
     */
    public function getDetailedStatistics()
    {
        $today = Carbon::today();
        
        $detailedStats = [
            // Statistik harian
            'today' => [
                'pendaftaran' => Pendaftaran::whereDate('tgl_pendaftaran', $today)->count(),
                'pemeriksaan_umum' => PemeriksaanUmum::whereDate('tgl_transfer', $today)->count(),
                'laboratorium' => Laboratorium::whereDate('created_at', $today)->count(),
                'radiologi' => Radiologi::whereDate('tgl_pemeriksaan', $today)->count(),
            ],
            
            // Statistik status pendaftaran
            'pendaftaran_status' => [
                'menunggu' => Pendaftaran::where('status', 'menunggu')->count(),
                'dikonfirmasi' => Pendaftaran::where('status', 'dikonfirmasi')->count(),
                'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
            ],
            
            // Statistik per jenis layanan
            'layanan' => [
                'pemeriksaan_umum' => [
                    'total' => PemeriksaanUmum::count(),
                    'menunggu' => PemeriksaanUmum::where('status_pemeriksaan', 'menunggu')->count(),
                    'sedang_diperiksa' => PemeriksaanUmum::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
                    'selesai' => PemeriksaanUmum::where('status_pemeriksaan', 'selesai')->count(),
                ],
                'laboratorium' => [
                    'total' => Laboratorium::count(),
                    'menunggu' => Laboratorium::where('status_pemeriksaan', 'menunggu')->count(),
                    'sedang_diperiksa' => Laboratorium::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
                    'selesai' => Laboratorium::where('status_pemeriksaan', 'selesai')->count(),
                ],
                'radiologi' => [
                    'total' => Radiologi::count(),
                    'menunggu' => Radiologi::where('status_pemeriksaan', 'menunggu')->count(),
                    'sedang_diperiksa' => Radiologi::where('status_pemeriksaan', 'sedang_diperiksa')->count(),
                    'selesai' => Radiologi::where('status_pemeriksaan', 'selesai')->count(),
                ],
            ]
        ];

        return response()->json($detailedStats);
    }

    /**
     * TAMBAHAN: Method untuk mendapatkan data real-time dashboard
     */
    public function getRealTimeData()
    {
        return response()->json([
            'pendaftaran_hari_ini' => Pendaftaran::whereDate('tgl_pendaftaran', Carbon::today())->count(),
            'antrian_aktif' => [
                'pemeriksaan_umum' => PemeriksaanUmum::whereIn('status_pemeriksaan', ['menunggu', 'sedang_diperiksa'])->count(),
                'laboratorium' => Laboratorium::whereIn('status_pemeriksaan', ['menunggu', 'sedang_diperiksa'])->count(),
                'radiologi' => Radiologi::whereIn('status_pemeriksaan', ['menunggu', 'sedang_diperiksa'])->count(),
            ],
            'selesai_hari_ini' => $this->getSelesaiHariIni(),
            'timestamp' => Carbon::now()->format('H:i:s')
        ]);
    }

    /**
     * Daftar pasien berdasarkan layanan
     */
    public function layanan($jenis)
    {
        if (!in_array($jenis, ['pemeriksaan_umum', 'lab', 'radiologi'])) {
            abort(404);
        }

        $pendaftaran = Pendaftaran::byKeluhan($jenis)
                                 ->byStatus('dikonfirmasi')
                                 ->orderBy('tgl_pendaftaran', 'desc')
                                 ->paginate(1000);

        $layananNama = [
            'pemeriksaan_umum' => 'Pemeriksaan Umum',
            'lab' => 'Laboratorium',
            'radiologi' => 'Radiologi'
        ];

        return view('admin.layanan.index', compact('pendaftaran', 'jenis', 'layananNama'));
    }
}