<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Radiologi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RadiologiController extends Controller
{
    /**
     * Halaman index untuk daftar radiologi
     */
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        
$radiologi = Radiologi::with(['pendaftaran', 'transferBy', 'antrianBy', 'mulaiPeriksaBy', 'selesaiPeriksaBy'])
                     ->byTanggalPemeriksaan($tanggal)
                     ->orderBy('created_at', 'desc')
                     ->paginate(100);

        $statistics = [
            'total_hari_ini' => Radiologi::byTanggalPemeriksaan($tanggal)->count(),
            'menunggu' => Radiologi::byTanggalPemeriksaan($tanggal)->byStatus('menunggu')->count(),
            'sedang_diperiksa' => Radiologi::byTanggalPemeriksaan($tanggal)->byStatus('sedang_diperiksa')->count(),
            'selesai' => Radiologi::byTanggalPemeriksaan($tanggal)->byStatus('selesai')->count(),
        ];

        return view('admin.radiologi.index', compact('radiologi', 'tanggal', 'statistics'));
    }

    /**
     * Transfer data dari pendaftaran ke radiologi
     */
    public function transfer(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Validasi apakah pendaftaran sudah dikonfirmasi
        if ($pendaftaran->status !== 'dikonfirmasi') {
            return back()->withErrors(['error' => 'Pendaftaran belum dikonfirmasi.']);
        }

        // Validasi apakah keluhan sesuai dengan radiologi
        if ($pendaftaran->keluhan !== 'radiologi') {
            return back()->withErrors(['error' => 'Keluhan pasien tidak sesuai untuk radiologi.']);
        }

        // Cek apakah sudah ditransfer sebelumnya
        $existingRadiologi = Radiologi::where('pendaftaran_id', $pendaftaran->id)->first();
        if ($existingRadiologi) {
            return back()->withErrors(['error' => 'Data pasien sudah ditransfer ke radiologi.']);
        }

        // Transfer data ke tabel radiologi
        Radiologi::create([
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
            'is_lpk_sentosa' => $pendaftaran->is_lpk_sentosa,
            'foto_bukti' => $pendaftaran->foto_bukti,
            'transfer_at' => now(),
                'transfer_by' => auth()->id()  
        ]);
// Update info transfer di pendaftaran
$pendaftaran->update([
    'transferred_by' => auth()->id(),
    'transferred_at' => now()
]);
        return back()->with('success', 'Data pasien berhasil ditransfer ke radiologi.');
    }

    /**
     * Update status pemeriksaan radiologi
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,sedang_diperiksa,selesai'
        ]);

        $radiologi = Radiologi::findOrFail($id);

$updateData = ['status_pemeriksaan' => $request->status];

if ($request->status === 'sedang_diperiksa') {
    $updateData['mulai_periksa_by'] = auth()->id();
        $updateData['mulai_periksa_at'] = now();

        $radiologi->update($updateData); 
}

$radiologi->update($updateData);

        return back()->with('success', 'Status pemeriksaan berhasil diupdate.');
    }

    /**
     * Detail radiologi
     */
    public function detail($id)
    {
    $radiologi = Radiologi::with([
        'pendaftaran', 
        'transferBy', 
        'antrianBy', 
        'mulaiPeriksaBy', 
        'selesaiPeriksaBy'
    ])->findOrFail($id);
        return view('admin.radiologi.detail', compact('radiologi'));
    }

    /**
     * Konfirmasi dan input hasil radiologi
     */
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'jenis_radiologi' => 'required|in:rontgen,ct_scan,mri,usg,mammografi',
            'hasil_radiologi' => 'required|string',
            'dokter_radiologi' => 'required|string|max:100',
            'teknisi_radiologi' => 'required|string|max:100',
            'catatan_radiologi' => 'nullable|string'
        ]);

        $radiologi = Radiologi::findOrFail($id);
        
        $radiologi->update([
            'status_pemeriksaan' => 'selesai',
            'jenis_radiologi' => $request->jenis_radiologi,
            'hasil_radiologi' => $request->hasil_radiologi,
            'dokter_radiologi' => $request->dokter_radiologi,
            'teknisi_radiologi' => $request->teknisi_radiologi,
            'catatan_radiologi' => $request->catatan_radiologi,
            'tgl_pemeriksaan' => Carbon::now(),
               'selesai_periksa_by' => auth()->id(),
                   'selesai_periksa_at' => now() 
        ]);

        return back()->with('success', 'Hasil radiologi berhasil disimpan.');
    }

   public function setAntrian(Request $request, $id)
{
    $radiologi = Radiologi::findOrFail($id);
    
    // Generate nomor antrian otomatis dengan format RAD-01
    $tanggal = Carbon::today();
    
    // Hitung total antrian yang sudah ada hari ini
    $totalAntrian = Radiologi::whereDate('tgl_pemeriksaan', $tanggal)
                            ->whereNotNull('no_antrian')
                            ->count();
    
    $nomorUrut = $totalAntrian + 1;
    $noAntrian = 'RAD-' . str_pad($nomorUrut, 2, '0', STR_PAD_LEFT);
    


    $radiologi->update([
    'no_antrian' => $noAntrian,
    'antrian_by' => auth()->id(),
        'antrian_at' => now()  // Tambahkan ini
]);
    return back()->with('success', 'Nomor antrian berhasil diberikan: ' . $noAntrian);
}
}   