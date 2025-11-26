<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeterangan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SuratKeteranganController extends Controller
{
    /**
     * Tampilan index surat sehat dengan live preview dan edit template
     */
    public function suratSehat(): View
    {
        try {
            $template = SuratKeterangan::getTemplateSehat();
            
            // Jika template belum ada, buat default
            if (!$template) {
                $template = $this->createDefaultTemplate('sehat');
            }

            return view('admin.suratketerangan.suratsehat', compact('template'));
        } catch (\Exception $e) {
            Log::error('Error loading surat sehat: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat template surat sehat.');
        }
    }

    /**
     * Tampilan index surat sakit dengan live preview dan edit template
     */
    public function suratSakit(): View
    {
        try {
            $template = SuratKeterangan::getTemplateSakit();
            
            // Jika template belum ada, buat default
            if (!$template) {
                $template = $this->createDefaultTemplate('sakit');
            }

            return view('admin.suratketerangan.suratsakit', compact('template'));
        } catch (\Exception $e) {
            Log::error('Error loading surat sakit: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat template surat sakit.');
        }
    }

    /**
     * Tampilan riwayat semua pencetakan surat
     */
    public function riwayat(Request $request): View
    {
        try {
            $query = SuratKeterangan::history()->with('user');

            // Filter by jenis surat jika ada
            if ($request->filled('jenis_surat')) {
                $query->where('jenis_surat', $request->jenis_surat);
            }

            // Filter by tanggal jika ada
            if ($request->filled('tanggal_mulai')) {
                $query->whereDate('printed_at', '>=', $request->tanggal_mulai);
            }

            if ($request->filled('tanggal_selesai')) {
                $query->whereDate('printed_at', '<=', $request->tanggal_selesai);
            }

            // Pagination
            $history = $query->latest('printed_at')->paginate(15);

            return view('admin.suratketerangan.riwayatsurat', compact('history'));
        } catch (\Exception $e) {
            Log::error('Error loading riwayat: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat riwayat surat.');
        }
    }

    /**
     * Update template via AJAX (auto-save)
     */
    public function updateTemplate(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'jenis_surat' => 'required|in:sehat,sakit',
                'content' => 'required|string|min:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first()
                ], 422);
            }

            // Cari template berdasarkan jenis surat
            $template = SuratKeterangan::template()
                ->where('jenis_surat', $request->jenis_surat)
                ->first();

            if (!$template) {
                // Buat template baru jika belum ada
                $template = SuratKeterangan::create([
                    'type' => 'template',
                    'jenis_surat' => $request->jenis_surat,
                    'content' => $request->content,
                ]);
            } else {
                // Update template yang sudah ada
                $template->update([
                    'content' => $request->content,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Template berhasil disimpan',
                'data' => $template
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating template: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate dan download PDF surat kosong
     */
   public function cetakSurat(Request $request, string $jenisSurat): Response
{
    try {
        $validator = Validator::make(['jenis_surat' => $jenisSurat], [
            'jenis_surat' => 'required|in:sehat,sakit',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Jenis surat tidak valid.');
        }

        // Ambil template berdasarkan jenis surat
        if ($jenisSurat === 'sehat') {
            $template = SuratKeterangan::getTemplateSehat();
        } else {
            $template = SuratKeterangan::getTemplateSakit();
        }

        // Jika template tidak ada, buat default
        if (!$template) {
            $template = $this->createDefaultTemplate($jenisSurat);
        }

        // Proses content untuk PDF
        $processedContent = $this->processContentForPDF($template->content);

        // Simpan history pencetakan
        SuratKeterangan::saveHistory($jenisSurat, auth()->id());

        // Generate PDF dengan konfigurasi yang tepat
        $pdf = Pdf::loadView('admin.suratketerangan.pdf-template', [
            'template' => (object) ['content' => $processedContent],
            'jenis_surat' => $jenisSurat,
            'tanggal_cetak' => now()->format('d/m/Y H:i:s')
        ]);

        // Set paper size dan orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Set options untuk render yang lebih baik
        $pdf->setOptions([
            'dpi' => 150,
            'defaultFont' => 'Times New Roman',
            'isRemoteEnabled' => false,
            'isPhpEnabled' => false
        ]);

        $filename = 'Surat_' . ucfirst($jenisSurat) . '_' . now()->format('Y-m-d_His') . '.pdf';

        return $pdf->download($filename);

    } catch (\Exception $e) {
        Log::error('Error generating PDF: ' . $e->getMessage());
        return back()->with('error', 'Gagal mencetak surat: ' . $e->getMessage());
    }
}

/**
 * Proses content template untuk PDF
 */
private function processContentForPDF(string $content): string
{
    // Bersihkan content
    $content = strip_tags($content, '<p><br><strong><b><table><tr><td><div><h1><h2><h3><h4><h5><h6><span>');
    
    // Hapus underscore berlebihan
    $content = preg_replace('/_{3,}/', '', $content);
    
    // PERBAIKAN: Ganti SEMUA variasi text-align
    $content = str_replace([
        'class="text-center"',
        'class="text-right"',
        'class="text-left"',
        'text-align: center',      // ← TAMBAHAN
        'text-align: right',       // ← TAMBAHAN  
        'text-align: left',        // ← TAMBAHAN
    ], [
        'style="text-align: center;"',
        'style="text-align: right;"',
        'style="text-align: left;"',
        'text-align: center',      // ← TAMBAHAN
        'text-align: right',       // ← TAMBAHAN
        'text-align: left',        // ← TAMBAHAN
    ], $content);
    
    return $content;
}

    /**
     * API endpoint untuk ambil template (untuk AJAX)
     */
    public function getTemplate(string $jenisSurat): JsonResponse
    {
        try {
            $validator = Validator::make(['jenis_surat' => $jenisSurat], [
                'jenis_surat' => 'required|in:sehat,sakit',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis surat tidak valid.'
                ], 422);
            }

            if ($jenisSurat === 'sehat') {
                $template = SuratKeterangan::getTemplateSehat();
            } else {
                $template = SuratKeterangan::getTemplateSakit();
            }

            if (!$template) {
                $template = $this->createDefaultTemplate($jenisSurat);
            }

            return response()->json([
                'success' => true,
                'data' => $template
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting template: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil template.'
            ], 500);
        }
    }

    /**
     * Hapus history pencetakan (optional)
     */
    public function deleteHistory(int $id): JsonResponse
    {
        try {
            $history = SuratKeterangan::history()->findOrFail($id);
            $history->delete();

            return response()->json([
                'success' => true,
                'message' => 'Riwayat berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting history: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus riwayat.'
            ], 500);
        }
    }

    /**
     * Method untuk membuat template default
     */
    private function createDefaultTemplate(string $jenisSurat): SuratKeterangan
    {
        $defaultContent = $this->getDefaultTemplateContent($jenisSurat);

        return SuratKeterangan::create([
            'type' => 'template',
            'jenis_surat' => $jenisSurat,
            'content' => $defaultContent,
        ]);
    }

    /**
     * Content default untuk template
     */
   /**
 * Content default untuk template
 */
private function getDefaultTemplateContent(string $jenisSurat): string
{
    if ($jenisSurat === 'sehat') {
        return '
            <div style="text-align: center; margin-bottom: 20px;">
                <h2><strong>SURAT KETERANGAN SEHAT</strong></h2>
                <p>No: <span class="blank-line"></span></p>
            </div>
            
            <p>Yang bertanda tangan di bawah ini, Dokter:</p>
            
            <table style="width: 100%; margin-bottom: 15px;">
                <tr>
                    <td style="width: 120px; padding: 5px 0;">Nama</td>
                    <td style="width: 20px; padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">SIP</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            </table>
            
            <p>Menerangkan bahwa:</p>
            
            <table style="width: 100%; margin-bottom: 15px;">
                <tr>
                    <td style="width: 120px; padding: 5px 0;">Nama</td>
                    <td style="width: 20px; padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">TTL</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Alamat</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Pekerjaan</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            </table>
            
            <p><strong>Dalam keadaan SEHAT</strong> dan dapat melakukan aktivitas normal.</p>
            
            <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="margin-top: 40px; text-align: right;">
                <p><span class="blank-line"></span>, <span class="blank-line"></span></p>
                <p style="margin-top: 60px;">
                    <strong><span class="blank-line"></span></strong><br>
                    Dokter
                </p>
            </div>
        ';
    } else {
        return '
            <div style="text-align: center; margin-bottom: 20px;">
                <h2><strong>SURAT KETERANGAN SAKIT</strong></h2>
                <p>No: <span class="blank-line"></span></p>
            </div>
            
            <p>Yang bertanda tangan di bawah ini, Dokter:</p>
            
            <table style="width: 100%; margin-bottom: 15px;">
                <tr>
                    <td style="width: 120px; padding: 5px 0;">Nama</td>
                    <td style="width: 20px; padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">SIP</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            </table>
            
            <p>Menerangkan bahwa:</p>
            
            <table style="width: 100%; margin-bottom: 15px;">
                <tr>
                    <td style="width: 120px; padding: 5px 0;">Nama</td>
                    <td style="width: 20px; padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">TTL</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Alamat</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Pekerjaan</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            </table>
            
            <p><strong>Sedang SAKIT</strong> dan perlu istirahat selama:</p>
            
            <table style="width: 100%; margin-bottom: 15px;">
                <tr>
                    <td style="width: 120px; padding: 5px 0;">Dari tanggal</td>
                    <td style="width: 20px; padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Sampai tanggal</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;">Diagnosis</td>
                    <td style="padding: 5px 0; text-align: center;">:</td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            </table>
            
            <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="margin-top: 40px; text-align: right;">
                <p><span class="blank-line"></span>, <span class="blank-line"></span></p>
                <p style="margin-top: 60px;">
                    <strong><span class="blank-line"></span></strong><br>
                    Dokter
                </p>
            </div>
        ';
    }
}
}