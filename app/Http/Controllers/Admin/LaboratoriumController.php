<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratorium;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaboratoriumController extends Controller
{
    /**
     * Halaman index untuk daftar laboratorium
     */
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        
$laboratorium = Laboratorium::with(['pendaftaran', 'userSetAntrian', 'userMulaiPeriksa', 'userSelesaiPeriksa'])
                                   ->byTanggalPemeriksaan($tanggal)
                                   ->orderBy('no_antrian', 'asc')
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(100);

       $statistics = [
    'total_hari_ini' => Laboratorium::byTanggalPemeriksaan($tanggal)->count(),
    'menunggu' => Laboratorium::byTanggalPemeriksaan($tanggal)->byStatus('menunggu')->whereNull('no_antrian')->count(),
    'siap_periksa' => Laboratorium::byTanggalPemeriksaan($tanggal)->byStatus('menunggu')->whereNotNull('no_antrian')->count(),
    'sedang_diperiksa' => Laboratorium::byTanggalPemeriksaan($tanggal)->byStatus('sedang_diperiksa')->count(),
    'selesai' => Laboratorium::byTanggalPemeriksaan($tanggal)->byStatus('selesai')->count(),
];

        return view('admin.laboratorium.index', compact('laboratorium', 'tanggal', 'statistics'));
    }

    /**
     * Transfer data dari pendaftaran ke laboratorium
     */
    public function transfer(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Validasi apakah pendaftaran sudah dikonfirmasi
        if ($pendaftaran->status !== 'dikonfirmasi') {
            return back()->withErrors(['error' => 'Pendaftaran belum dikonfirmasi.']);
        }

        // Validasi apakah keluhan sesuai dengan laboratorium
        if ($pendaftaran->keluhan !== 'lab') {
            return back()->withErrors(['error' => 'Keluhan pasien tidak sesuai untuk laboratorium.']);
        }

        // Cek apakah sudah ditransfer sebelumnya
        $existingLab = Laboratorium::where('pendaftaran_id', $pendaftaran->id)->first();
        if ($existingLab) {
            return back()->withErrors(['error' => 'Data pasien sudah ditransfer ke laboratorium.']);
        }

        // Transfer data ke tabel laboratorium
        Laboratorium::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nik' => $pendaftaran->nik,
            'nama' => $pendaftaran->nama,
            'no_rekam_medis' => $pendaftaran->no_rekam_medis,
            'jenis_kelamin' => $pendaftaran->jenis_kelamin,
            'tgl_lahir' => $pendaftaran->tgl_lahir,
            'no_hp' => $pendaftaran->no_hp,
            'email' => $pendaftaran->email,
            'alamat_lengkap' => $pendaftaran->alamat_lengkap,
            'keluhan' => $pendaftaran->keluhan,
            'kontak_darurat' => $pendaftaran->kontak_darurat,
            'hubungan_kontak' => $pendaftaran->hubungan_kontak,
            'status_pemeriksaan' => 'menunggu',
            'tgl_pemeriksaan' => Carbon::today(),
            'foto_bukti' => $pendaftaran->foto_bukti,
            'is_lpk_sentosa' => $pendaftaran->is_lpk_sentosa
        ]);
// Update info transfer di pendaftaran
$pendaftaran->update([
    'transferred_by' => auth()->id(),
    'transferred_at' => now()
]);
        return back()->with('success', 'Data pasien berhasil ditransfer ke laboratorium.');
    }


  public function setAntrian($id)
{
    try {
        $laboratorium = Laboratorium::findOrFail($id);
        
        // Validasi status
        if ($laboratorium->status_pemeriksaan !== 'menunggu') {
            return back()->withErrors(['error' => 'Status tidak valid untuk set antrian.']);
        }
        
        // Validasi apakah sudah ada nomor antrian
        if ($laboratorium->no_antrian) {
            return back()->withErrors(['error' => 'Nomor antrian sudah ditetapkan: ' . $laboratorium->no_antrian]);
        }
        
        // Generate nomor antrian dengan retry mechanism
        $maxAttempts = 3;
        $success = false;
        $noAntrian = null;
        $lastError = null;
        
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                // Generate nomor antrian baru
                $noAntrian = Laboratorium::generateNoAntrian($laboratorium->tgl_pemeriksaan);
                
                // Update dengan kondisi yang ketat untuk mencegah race condition
                $updated = Laboratorium::where('id', $id)
                     ->where('status_pemeriksaan', 'menunggu') 
                     ->whereNull('no_antrian')
                     ->update([
                         'no_antrian' => $noAntrian,
                         'set_antrian_by' => auth()->id(),
                         'set_antrian_at' => now()
                     ]);

                if ($updated) {
                    // Double check apakah benar-benar terupdate
                    $laboratorium->refresh();
                    if ($laboratorium->no_antrian === $noAntrian) {
                        $success = true;
                        break;
                    }
                }
                
                // Jika gagal, tunggu sebentar sebelum retry
                if ($attempt < $maxAttempts) {
                    usleep(rand(100000, 200000)); // 0.1-0.2 detik
                }
                
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
                if ($attempt < $maxAttempts) {
                    usleep(rand(100000, 200000));
                    continue;
                }
            }
        }
        
        if ($success) {
            return back()->with('success', 'Kode antrian berhasil ditetapkan: ' . $noAntrian);
        } else {
            // Cek apakah mungkin sudah diset oleh proses lain
            $laboratorium->refresh();
            if ($laboratorium->no_antrian) {
                return back()->with('success', 'Nomor antrian sudah ditetapkan: ' . $laboratorium->no_antrian);
            } else {
                $errorMsg = $lastError ? 'Error: ' . $lastError : 'Gagal menetapkan nomor antrian setelah beberapa percobaan';
                return back()->withErrors(['error' => $errorMsg]);
            }
        }
        
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
}

public function setAntrianWithFileLock($id)
{
    $lockFile = storage_path('app/locks/antrian_lab_' . date('Y-m-d') . '.lock');
    
    try {
        $laboratorium = Laboratorium::findOrFail($id);
        
        if ($laboratorium->status_pemeriksaan !== 'menunggu') {
            return back()->withErrors(['error' => 'Status tidak valid untuk set antrian.']);
        }
        
        if ($laboratorium->no_antrian) {
            return back()->withErrors(['error' => 'Nomor antrian sudah ditetapkan: ' . $laboratorium->no_antrian]);
        }
        
        // Buat direktori jika belum ada
        $lockDir = dirname($lockFile);
        if (!is_dir($lockDir)) {
            mkdir($lockDir, 0755, true);
        }
        
        // Dapatkan file lock
        $fp = fopen($lockFile, 'w');
        if (!$fp) {
            throw new \Exception('Tidak dapat membuat lock file');
        }
        
        if (flock($fp, LOCK_EX)) {
            try {
                // Generate dan set nomor antrian dalam lock
                $noAntrian = Laboratorium::generateNoAntrian($laboratorium->tgl_pemeriksaan);
                
                $updated = Laboratorium::where('id', $id)
                                     ->where('status_pemeriksaan', 'menunggu')
                                     ->whereNull('no_antrian')
                                     ->update(['no_antrian' => $noAntrian]);
                
                if ($updated) {
                    flock($fp, LOCK_UN);
                    fclose($fp);
                    return back()->with('success', 'Kode antrian berhasil ditetapkan: ' . $noAntrian);
                } else {
                    throw new \Exception('Gagal update nomor antrian');
                }
                
            } finally {
                flock($fp, LOCK_UN);
            }
        } else {
            fclose($fp);
            throw new \Exception('Tidak dapat mendapatkan lock');
        }
        
        fclose($fp);
        
    } catch (\Exception $e) {
        if (isset($fp) && is_resource($fp)) {
            fclose($fp);
        }
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

    /**
     * Update status pemeriksaan laboratorium
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,sedang_diperiksa,selesai'
        ]);

        $laboratorium = Laboratorium::findOrFail($id);
$updateData = ['status_pemeriksaan' => $request->status];

if ($request->status === 'sedang_diperiksa') {
    $updateData['mulai_periksa_by'] = auth()->id();
    $updateData['mulai_periksa_at'] = now();
}

$laboratorium->update($updateData);

        return back()->with('success', 'Status pemeriksaan berhasil diupdate.');
    }

    /**
     * Detail laboratorium
     */
    public function detail($id)
    {
        $laboratorium = Laboratorium::with('pendaftaran')->findOrFail($id);
        return view('admin.laboratorium.detail', compact('laboratorium'));
    }

    /**
     * Konfirmasi dan input hasil laboratorium
     */
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'hasil_lab' => 'required|string',
            'dokter_pemeriksa' => 'required|string|max:100',
            'catatan_lab' => 'nullable|string'
        ]);

        $laboratorium = Laboratorium::findOrFail($id);
        
        $laboratorium->update([
            'status_pemeriksaan' => 'selesai',
            'hasil_lab' => $request->hasil_lab,
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'catatan_lab' => $request->catatan_lab,
            'selesai_periksa_by' => auth()->id(),
'selesai_periksa_at' => now(),
            'tgl_pemeriksaan' => Carbon::now()
        ]);

        return back()->with('success', 'Hasil laboratorium berhasil disimpan.');
    }
}