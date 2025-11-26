<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan form pendaftaran
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    /**
     * Simpan data pendaftaran
     */
    public function store(Request $request)
    {
        // Validasi custom untuk NIK
        $this->validateNikRegistration($request);

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
        ], [
            'nik.required' => 'NIK KTP wajib diisi',
            'nik.size' => 'NIK KTP harus 16 digit',
            'nama.required' => 'Nama wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'tgl_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_bpjs.size' => 'Nomor BPJS harus 13 digit',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi',
            'kontak_darurat.required' => 'Kontak darurat wajib diisi',
            'hubungan_kontak.required' => 'Hubungan kontak darurat wajib dipilih',
            'keluhan.required' => 'Jenis layanan wajib dipilih',
            'tgl_pendaftaran.required' => 'Tanggal pendaftaran wajib diisi',
            'tgl_pendaftaran.after_or_equal' => 'Tanggal pendaftaran tidak boleh kurang dari hari ini',
        ]);

        try {
            $data = $request->all();
            $data['status'] = 'menunggu';
            $data['waktu_submit'] = now();
            
            // Cek apakah NIK sudah pernah dikonfirmasi sebelumnya
            $isReturningPatient = Pendaftaran::isNikConfirmed($request->nik);
            
            if ($isReturningPatient) {
                // Pasien lama - langsung set no rekam medis dari pendaftaran sebelumnya
                $data['no_rekam_medis'] = Pendaftaran::getNoRekamMedisByNik($request->nik);
            } else {
                // Pasien baru - no rekam medis akan di-generate saat konfirmasi
                $data['no_rekam_medis'] = null;
            }
            
            $pendaftaran = Pendaftaran::create($data);

            // Pesan sukses berbeda untuk pasien lama dan baru
            $successMessage = $isReturningPatient 
                ? 'Pendaftaran berhasil! Sebagai pasien lama, Anda sudah memiliki nomor rekam medis. Silakan tunggu konfirmasi dari admin.'
                : 'Pendaftaran berhasil! Silakan tunggu konfirmasi dari admin.';

            return redirect()->route('pendaftaran.success')->with([
                'success' => $successMessage,
                'pendaftaran_id' => $pendaftaran->id,
                'waktu_submit' => $pendaftaran->waktu_submit_indonesia,
                'is_returning_patient' => $isReturningPatient,
                'no_rekam_medis' => $pendaftaran->no_rekam_medis,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Validasi khusus untuk pendaftaran NIK
     */
    private function validateNikRegistration(Request $request)
    {
        $nik = $request->nik;
        
        if (!$nik) {
            return; // Akan ditangani oleh validasi utama
        }

        // Cek apakah NIK masih ada yang menunggu konfirmasi
        if (Pendaftaran::hasWaitingRegistration($nik)) {
            throw ValidationException::withMessages([
                'nik' => 'NIK ini masih memiliki pendaftaran yang menunggu konfirmasi. Silakan tunggu konfirmasi admin terlebih dahulu.'
            ]);
        }
    }

    /**
     * Halaman sukses pendaftaran
     */
    public function success()
    {
        $waktuSubmit = session('waktu_submit');
        $pendaftaranId = session('pendaftaran_id');
        $isReturningPatient = session('is_returning_patient', false);
        $noRekamMedis = session('no_rekam_medis');
        
        return view('pendaftaran.success', compact('waktuSubmit', 'pendaftaranId', 'isReturningPatient', 'noRekamMedis'));
    }

    /**
     * Cek status pendaftaran berdasarkan NIK
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16'
        ]);

        $pendaftaran = Pendaftaran::where('nik', $request->nik)
                                 ->orderBy('created_at', 'desc')
                                 ->first();

        if (!$pendaftaran) {
            return back()->withErrors(['nik' => 'Data pendaftaran tidak ditemukan.']);
        }

        return view('pendaftaran.status', compact('pendaftaran'));
    }

    /**
     * Form cek status
     */
    public function showCheckStatus()
    {
        return view('pendaftaran.check-status');
    }

    /**
     * Method untuk mendapatkan laporan pendaftaran berdasarkan tanggal
     */
    public function laporanHarian(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        
        $pendaftaran = Pendaftaran::byWaktuSubmit($tanggal)
                                 ->orderBy('waktu_submit', 'desc')
                                 ->get();
        
        return view('pendaftaran.laporan-harian', compact('pendaftaran', 'tanggal'));
    }
}