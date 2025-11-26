<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanUmum;
use App\Models\Radiologi;
use App\Models\Laboratorium;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsAppController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        $jenis_layanan = $request->get('jenis_layanan', 'all');
        
        $query = collect();
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'pemeriksaan_umum') {
            $pemeriksaanUmum = PemeriksaanUmum::with('pendaftaran')
                ->whereDate('tgl_transfer', $tanggal)
                ->whereNotNull('no_hp')
                ->where('no_hp', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Pemeriksaan Umum',
                        'status' => $item->status_pemeriksaan_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => 'Pemeriksaan Umum',
                        'tanggal' => $item->tgl_transfer->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($pemeriksaanUmum);
        }
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'radiologi') {
            $radiologi = Radiologi::with('pendaftaran')
                ->whereDate('tgl_pemeriksaan', $tanggal)
                ->whereNotNull('no_hp')
                ->where('no_hp', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Radiologi',
                        'status' => $item->status_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => $item->jenis_radiologi_label,
                        'tanggal' => $item->tgl_pemeriksaan->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($radiologi);
        }
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'laboratorium') {
            $laboratorium = Laboratorium::with('pendaftaran')
                ->whereDate('tgl_pemeriksaan', $tanggal)
                ->whereNotNull('no_hp')
                ->where('no_hp', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Laboratorium',
                        'status' => $item->status_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => 'Laboratorium',
                        'tanggal' => $item->tgl_pemeriksaan->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($laboratorium);
        }
        
        // Jika ada pencarian berdasarkan nama atau nomor HP
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query = $query->filter(function($item) use ($search) {
                return strpos(strtolower($item['nama']), $search) !== false ||
                       strpos($item['no_hp'], $search) !== false;
            });
        }
        
        // Urutkan berdasarkan nama
        $data = $query->sortBy('nama')->values();
        
        return view('admin.whatsapp.index', compact('data', 'tanggal', 'jenis_layanan'));
    }
    
    public function email(Request $request)
    {
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        $jenis_layanan = $request->get('jenis_layanan', 'all');
        
        $query = collect();
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'pemeriksaan_umum') {
            $pemeriksaanUmum = PemeriksaanUmum::with('pendaftaran')
                ->whereDate('tgl_transfer', $tanggal)
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Pemeriksaan Umum',
                        'status' => $item->status_pemeriksaan_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => 'Pemeriksaan Umum',
                        'tanggal' => $item->tgl_transfer->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($pemeriksaanUmum);
        }
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'radiologi') {
            $radiologi = Radiologi::with('pendaftaran')
                ->whereDate('tgl_pemeriksaan', $tanggal)
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Radiologi',
                        'status' => $item->status_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => $item->jenis_radiologi_label,
                        'tanggal' => $item->tgl_pemeriksaan->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($radiologi);
        }
        
        if ($jenis_layanan == 'all' || $jenis_layanan == 'laboratorium') {
            $laboratorium = Laboratorium::with('pendaftaran')
                ->whereDate('tgl_pemeriksaan', $tanggal)
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama,
                        'no_hp' => $item->no_hp,
                        'jenis_layanan' => 'Laboratorium',
                        'status' => $item->status_label,
                        'no_antrian' => $item->no_antrian,
                        'email' => $item->email,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'keluhan' => 'Laboratorium',
                        'tanggal' => $item->tgl_pemeriksaan->format('d/m/Y'),
                        'is_lpk_sentosa' => $item->pendaftaran ? $item->pendaftaran->is_lpk_sentosa : false
                    ];
                });
            $query = $query->concat($laboratorium);
        }
        
        // Jika ada pencarian berdasarkan nama atau email
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query = $query->filter(function($item) use ($search) {
                return strpos(strtolower($item['nama']), $search) !== false ||
                       strpos(strtolower($item['email']), $search) !== false;
            });
        }
        
        // Urutkan berdasarkan nama
        $data = $query->sortBy('nama')->values();
        
        return view('admin.whatsapp.email', compact('data', 'tanggal', 'jenis_layanan'));
    }
    
    /**
     * Generate pesan WhatsApp berdasarkan data pasien
     */
    public function generateWhatsAppMessage($data)
    {
        $message = "Halo {$data['nama']},\n\n";
        $message .= "Informasi layanan kesehatan Anda:\n";
        $message .= "• Jenis Layanan: {$data['jenis_layanan']}\n";
        $message .= "• No. Rekam Medis: {$data['no_rekam_medis']}\n";
        $message .= "• Tanggal: {$data['tanggal']}\n";
        
        if (!empty($data['no_antrian'])) {
            $message .= "• No. Antrian: {$data['no_antrian']}\n";
        }
        
        $message .= "• Status: {$data['status']}\n\n";
        $message .= "Terima kasih telah menggunakan layanan kami.\n\n";
        $message .= "Salam,\nKlinik Kesehatan";
        
        return $message;
    }
    
    /**
     * Generate template email berdasarkan data pasien
     */
    public function generateEmailTemplate($data)
    {
        $subject = "Informasi Layanan Kesehatan - {$data['jenis_layanan']}";
        
        $body = "Kepada Yth. {$data['nama']},\n\n";
        $body .= "Kami ingin menginformasikan status layanan kesehatan Anda:\n\n";
        $body .= "Detail Layanan:\n";
        $body .= "• Jenis Layanan: {$data['jenis_layanan']}\n";
        $body .= "• No. Rekam Medis: {$data['no_rekam_medis']}\n";
        $body .= "• Tanggal Layanan: {$data['tanggal']}\n";
        
        if (!empty($data['no_antrian'])) {
            $body .= "• No. Antrian: {$data['no_antrian']}\n";
        }
        
        $body .= "• Status Saat Ini: {$data['status']}\n\n";
        $body .= "Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami.\n\n";
        $body .= "Terima kasih atas kepercayaan Anda.\n\n";
        $body .= "Salam hormat,\n";
        $body .= "Tim Klinik Kesehatan";
        
        return [
            'subject' => $subject,
            'body' => $body
        ];
    }
    
    /**
     * Redirect ke WhatsApp dengan pesan yang sudah disiapkan
     */
    public function redirectToWhatsApp($phoneNumber, $message)
    {
        // Bersihkan nomor telepon (hapus karakter non-digit)
        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Jika nomor dimulai dengan 0, ganti dengan 62
        if (substr($cleanPhone, 0, 1) == '0') {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }
        
        // Encode pesan untuk URL
        $encodedMessage = urlencode($message);
        
        // Generate WhatsApp URL
        $whatsappUrl = "https://wa.me/{$cleanPhone}?text={$encodedMessage}";
        
        return redirect()->away($whatsappUrl);
    }
}