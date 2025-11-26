<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanUmum;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemeriksaanUmumController extends Controller
{
    /**
     * Halaman index untuk daftar pemeriksaan umum
     */
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        
$pemeriksaanUmum = PemeriksaanUmum::with(['pendaftaran', 'konfirmasiBy', 'mulaiPeriksaBy', 'selesaiPeriksaBy'])
                                 ->byTanggalTransfer($tanggal)
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(100);

        $statistics = [
            'total_hari_ini' => PemeriksaanUmum::byTanggalTransfer($tanggal)->count(),
            'menunggu' => PemeriksaanUmum::byTanggalTransfer($tanggal)->byStatusPemeriksaan('menunggu')->count(),
            'dikonfirmasi' => PemeriksaanUmum::byTanggalTransfer($tanggal)->byStatusPemeriksaan('dikonfirmasi')->count(),
            'sedang_diperiksa' => PemeriksaanUmum::byTanggalTransfer($tanggal)->byStatusPemeriksaan('sedang_diperiksa')->count(),
            'selesai' => PemeriksaanUmum::byTanggalTransfer($tanggal)->byStatusPemeriksaan('selesai')->count(),
        ];

        return view('admin.pemeriksaanumum.index', compact('pemeriksaanUmum', 'tanggal', 'statistics'));
    }

    /**
     * Transfer data dari pendaftaran ke pemeriksaan umum
     */
    public function transfer(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Validasi apakah pendaftaran sudah dikonfirmasi dan memiliki no rekam medis
        if ($pendaftaran->status !== 'dikonfirmasi' || !$pendaftaran->no_rekam_medis) {
            return back()->withErrors(['error' => 'Pendaftaran belum dikonfirmasi atau belum memiliki nomor rekam medis.']);
        }

        // Validasi apakah keluhan sesuai dengan pemeriksaan umum
        if ($pendaftaran->keluhan !== 'pemeriksaan_umum') {
            return back()->withErrors(['error' => 'Keluhan pasien tidak sesuai untuk pemeriksaan umum.']);
        }

        // Cek apakah sudah pernah ditransfer
        $existing = PemeriksaanUmum::where('pendaftaran_id', $pendaftaran->id)->first();
        if ($existing) {
            return back()->withErrors(['error' => 'Data pendaftaran ini sudah pernah ditransfer ke pemeriksaan umum.']);
        }

        // Transfer data
        PemeriksaanUmum::create([
            'pendaftaran_id' => $pendaftaran->id,
            'no_rekam_medis' => $pendaftaran->no_rekam_medis,
            'nik' => $pendaftaran->nik,
            'nama' => $pendaftaran->nama,
            'jenis_kelamin' => $pendaftaran->jenis_kelamin,
            'tgl_lahir' => $pendaftaran->tgl_lahir,
            'no_hp' => $pendaftaran->no_hp,
            'email' => $pendaftaran->email, // TAMBAHAN BARU
            'no_bpjs' => $pendaftaran->no_bpjs,
            'alamat_lengkap' => $pendaftaran->alamat_lengkap,
            'kontak_darurat' => $pendaftaran->kontak_darurat,
            'hubungan_kontak' => $pendaftaran->hubungan_kontak,
            'catatan' => $pendaftaran->catatan,
            'tgl_transfer' => Carbon::today(),
            'status_pemeriksaan' => 'menunggu',
            'foto_bukti' => $pendaftaran->foto_bukti,
            'is_lpk_sentosa' => $pendaftaran->is_lpk_sentosa // TAMBAHAN BARU
            
        ]);
// Update info transfer di pendaftaran
$pendaftaran->update([
    'transferred_by' => auth()->id(),
    'transferred_at' => now()
]);
        return back()->with('success', 'Data berhasil ditransfer ke pemeriksaan umum.');
    }

    /**
     * Konfirmasi pemeriksaan dan beri nomor antrian
     */
    public function konfirmasi(Request $request, $id)
    {
        $pemeriksaan = PemeriksaanUmum::findOrFail($id);
        
        if ($pemeriksaan->status_pemeriksaan !== 'menunggu') {
            return back()->withErrors(['error' => 'Status pemeriksaan tidak valid untuk dikonfirmasi.']);
        }

        $noAntrian = PemeriksaanUmum::generateNoAntrian($pemeriksaan->tgl_transfer);
        
        $pemeriksaan->update([
            'no_antrian' => $noAntrian,
            'status_pemeriksaan' => 'dikonfirmasi',
            'waktu_konfirmasi' => Carbon::now(),
            'konfirmasi_by' => auth()->id() 
        ]);

        return back()->with('success', "Berhasil dikonfirmasi dengan No. Antrian: $noAntrian");
    }

    /**
     * Update status pemeriksaan
     */
    public function updateStatus(Request $request, $id)
    {
        $rules = [
            'status_pemeriksaan' => 'required|in:dikonfirmasi,sedang_diperiksa,selesai'
        ];

        if ($request->status_pemeriksaan === 'selesai') {
            $rules['diagnosis_sementara'] = 'required|string';
            $rules['obat_diberikan'] = 'nullable|string';
            $rules['anjuran_instruksi'] = 'nullable|string';
            $rules['rujukan'] = 'nullable|string';
        }

        $request->validate($rules);

        $pemeriksaan = PemeriksaanUmum::findOrFail($id);
        
        $updateData = ['status_pemeriksaan' => $request->status_pemeriksaan];
        
        // Set timestamp berdasarkan status
       if ($request->status_pemeriksaan === 'sedang_diperiksa') {
    $updateData['waktu_mulai_periksa'] = Carbon::now();
    $updateData['mulai_periksa_by'] = auth()->id(); // TAMBAHAN INI
} elseif ($request->status_pemeriksaan === 'selesai') {
    $updateData = array_merge($updateData, [
        'diagnosis_sementara' => $request->diagnosis_sementara,
        'obat_diberikan' => $request->obat_diberikan,
        'anjuran_instruksi' => $request->anjuran_instruksi,
        'rujukan' => $request->rujukan,
        'waktu_selesai_periksa' => Carbon::now(),
        'selesai_periksa_by' => auth()->id() // TAMBAHAN INI
    ]);
}
        
        $pemeriksaan->update($updateData);

        return back()->with('success', 'Status pemeriksaan berhasil diperbarui.');
    }

    /**
     * Detail pemeriksaan umum
     */
    public function detail($id)
    {
        $pemeriksaan = PemeriksaanUmum::with('pendaftaran')->findOrFail($id);
        return view('admin.pemeriksaanumum.detail', compact('pemeriksaan'));
    }
}