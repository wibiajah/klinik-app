<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PemeriksaanUmum;
use App\Models\Laboratorium;
use App\Models\Radiologi;
use App\Models\User;

class PendaftaranController extends Controller
{
    /**
     * Halaman index untuk daftar pendaftaran
     */
    public function index(Request $request)
{
    $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
    
$pendaftaran = Pendaftaran::with(['pemeriksaanUmum', 'laboratorium', 'radiologi', 'transferredBy'])
                         ->byTanggalPendaftaran($tanggal)
                         ->orderBy('created_at', 'desc')
                         ->paginate(100);

    // Cek status transfer
    $this->checkTransferStatus($pendaftaran);

    $statistics = [
        'total_hari_ini' => Pendaftaran::byTanggalPendaftaran($tanggal)->count(),
        'menunggu' => Pendaftaran::byTanggalPendaftaran($tanggal)->byStatus('menunggu')->count(),
        'dikonfirmasi' => Pendaftaran::byTanggalPendaftaran($tanggal)->byStatus('dikonfirmasi')->count(),
        'ditolak' => Pendaftaran::byTanggalPendaftaran($tanggal)->byStatus('ditolak')->count(),
    ];

    return view('admin.pendaftaran.index', compact('pendaftaran', 'tanggal', 'statistics'));
}

public function create()
{
    return view('admin.pendaftaran.create');
}

   public function store(Request $request)
    {
        // Validasi NIK - hapus unique rule karena sekarang boleh duplikat
        $request->validate([
            'nik' => 'required|string|size:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date|before:today',
            'no_hp' => 'required|string|max:15',
            'no_bpjs' => 'nullable|string|size:13',
            'alamat_lengkap' => 'required|string',
            'kontak_darurat' => 'required|string|max:15',
            'hubungan_kontak' => 'required|in:ayah,ibu,saudara',
            'keluhan' => 'required|in:pemeriksaan_umum,lab,radiologi',
            'catatan' => 'nullable|string',
            'tgl_pendaftaran' => 'required|date|after_or_equal:today',
        ]);

        // Cek apakah NIK masih ada yang menunggu konfirmasi
        if (Pendaftaran::hasWaitingRegistration($request->nik)) {
            return back()->withErrors(['nik' => 'NIK ini masih memiliki pendaftaran yang menunggu konfirmasi.'])->withInput();
        }

        try {
            $data = $request->all();
            $data['status'] = 'menunggu';
            $data['waktu_submit'] = Carbon::now();
            
            // Cek apakah pasien lama
            $isReturningPatient = Pendaftaran::isNikConfirmed($request->nik);
            
            if ($isReturningPatient) {
                // Set no rekam medis dari pendaftaran sebelumnya
                $data['no_rekam_medis'] = Pendaftaran::getNoRekamMedisByNik($request->nik);
            } else {
                // Pasien baru - no rekam medis akan di-generate saat konfirmasi
                $data['no_rekam_medis'] = null;
            }
            
            Pendaftaran::create($data);

            $message = $isReturningPatient 
                ? 'Data pendaftaran pasien lama berhasil ditambahkan.'
                : 'Data pendaftaran pasien baru berhasil ditambahkan.';

            return redirect()->route('admin.pendaftaran.index')
                           ->with('success', $message);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }
/**
 * Tampilkan form edit pendaftaran
 */
public function edit($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    return view('admin.pendaftaran.edit', compact('pendaftaran'));
}

/**
 * Update data pendaftaran
 */
public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        $request->validate([
            'nik' => 'required|string|size:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date|before:today',
            'no_hp' => 'required|string|max:15',
            'no_bpjs' => 'nullable|string|size:13',
            'alamat_lengkap' => 'required|string',
            'kontak_darurat' => 'required|string|max:15',
            'hubungan_kontak' => 'required|in:ayah,ibu,saudara',
            'keluhan' => 'required|in:pemeriksaan_umum,lab,radiologi',
            'catatan' => 'nullable|string',
            'tgl_pendaftaran' => 'required|date|after_or_equal:today',
        ]);

        // Cek NIK berubah dan masih ada yang menunggu
        if ($request->nik != $pendaftaran->nik && Pendaftaran::hasWaitingRegistration($request->nik)) {
            return back()->withErrors(['nik' => 'NIK ini masih memiliki pendaftaran yang menunggu konfirmasi.'])->withInput();
        }

        try {
            $data = $request->all();
            
            // Jika NIK berubah, cek apakah pasien lama
            if ($request->nik != $pendaftaran->nik) {
                $isReturningPatient = Pendaftaran::isNikConfirmed($request->nik);
                if ($isReturningPatient) {
                    $data['no_rekam_medis'] = Pendaftaran::getNoRekamMedisByNik($request->nik);
                } else {
                    $data['no_rekam_medis'] = null;
                }
            }
            
            $pendaftaran->update($data);

            return redirect()->route('admin.pendaftaran.index')
                           ->with('success', 'Data pendaftaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.'])->withInput();
        }
    }

/**
 * Hapus data pendaftaran
 */
public function destroy($id)
{
    try {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Cek apakah sudah dikonfirmasi atau ditransfer
        if ($pendaftaran->status == 'dikonfirmasi') {
            return back()->withErrors(['error' => 'Tidak dapat menghapus pendaftaran yang sudah dikonfirmasi.']);
        }

        // Cek apakah sudah ditransfer ke layanan lain
        if ($pendaftaran->isTransferredToPemeriksaanUmum() || 
            $pendaftaran->isTransferredToLaboratorium() || 
            $pendaftaran->isTransferredToRadiologi()) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus pendaftaran yang sudah ditransfer ke layanan.']);
        }

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
                       ->with('success', 'Data pendaftaran berhasil dihapus.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
    }
}

    /**
     * Konfirmasi pendaftaran pasien
     */
   public function konfirmasi(Request $request, $id)
{
    try {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if ($pendaftaran->status !== 'menunggu') {
            return back()->withErrors(['error' => 'Pendaftaran sudah diproses sebelumnya.']);
        }

        // Validasi input email dan no_hp (yang mungkin diupdate)
$request->validate([
    'email' => 'required|email|max:255',
    'no_hp' => 'required|string|max:15',
    'is_lpk_sentosa' => 'boolean',
    'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // TAMBAH INI
]);

        // Pastikan waktu_submit ada
        if (!$pendaftaran->waktu_submit) {
            $pendaftaran->waktu_submit = Carbon::now();
            $pendaftaran->save();
        }

        $isReturningPatient = Pendaftaran::isNikConfirmed($pendaftaran->nik);
        
        // Update data tambahan (email, no_hp, is_lpk_sentosa)
$dataUpdate = [
    'email' => $request->email,
    'no_hp' => $request->no_hp,
    'is_lpk_sentosa' => $request->has('is_lpk_sentosa') ? true : false,
    'status' => 'dikonfirmasi'
];

// Handle foto bukti jika ada
if ($request->hasFile('foto_bukti')) {
    $file = $request->file('foto_bukti');
    $filename = 'foto_bukti_' . $pendaftaran->id . '_' . time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs('public/foto_bukti', $filename);
    $dataUpdate['foto_bukti'] = $filename;
}

$pendaftaran->update($dataUpdate);
        
        if ($isReturningPatient) {
            // Pasien lama - pastikan no rekam medis sudah ada
            if (!$pendaftaran->no_rekam_medis) {
                $pendaftaran->setExistingNoRekamMedis();
            }
            
            return back()->with('success', 'Pendaftaran pasien lama berhasil dikonfirmasi. No. Rekam Medis: ' . $pendaftaran->no_rekam_medis);
            
        } else {
            // Pasien baru - generate no rekam medis baru
            if ($pendaftaran->no_rekam_medis) {
                return back()->withErrors(['error' => 'Pendaftaran sudah memiliki nomor rekam medis.']);
            }

            $noRekamMedis = $pendaftaran->generateNoRekamMedis();
            
            $pendaftaran->update([
                'no_rekam_medis' => $noRekamMedis
            ]);

            return back()->with('success', 'Pendaftaran pasien baru berhasil dikonfirmasi. No. Rekam Medis: ' . $noRekamMedis);
        }
        
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

    /**
     * Tolak pendaftaran pasien
     */
    public function tolak(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if ($pendaftaran->status !== 'menunggu') {
            return back()->withErrors(['error' => 'Pendaftaran sudah diproses sebelumnya.']);
        }

        $pendaftaran->update(['status' => 'ditolak']);

        return back()->with('success', 'Pendaftaran berhasil ditolak.');
    }

    /**
     * Detail pendaftaran
     */
    public function detail($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.detail', compact('pendaftaran'));
    }

  private function checkTransferStatus($pendaftaran)
{
    foreach ($pendaftaran as $item) {
        // Cek apakah sudah ditransfer berdasarkan keluhan
        switch ($item->keluhan) {
            case 'pemeriksaan_umum':
                $item->is_transferred = $item->pemeriksaanUmum()->exists();
                break;
            case 'lab':
                $item->is_transferred = $item->laboratorium()->exists();
                break;
            case 'radiologi':
                $item->is_transferred = $item->radiologi()->exists(); // Tambahkan ini
                break;
            default:
                $item->is_transferred = false;
        }
    }
    
    return $pendaftaran;
}

}