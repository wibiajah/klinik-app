<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiayaPeralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiayaPeralatanController extends Controller
{
    /**
     * Display a listing of the resource by category.
     */
    public function index($kategori)
    {
        $validKategori = ['pemeriksaan-umum', 'laboratorium', 'radiologi'];
        
        if (!in_array($kategori, $validKategori)) {
            abort(404);
        }

        $peralatan = BiayaPeralatan::where('kategori', $kategori)
            ->orderBy('nama_alat')
            ->paginate(10);

        return view("admin.biayaperalatan.{$kategori}", compact('peralatan', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori)
    {
        $validKategori = ['pemeriksaan-umum', 'laboratorium', 'radiologi'];
        
        if (!in_array($kategori, $validKategori)) {
            abort(404);
        }

        return view("admin.biayaperalatan.create", compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kategori)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'nomor_seri' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|integer|min:1900|max:' . date('Y'),
            'harga_beli' => 'required|numeric|min:0',
            'biaya_operasional' => 'required|numeric|min:0',
            'biaya_perawatan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,tidak_aktif,rusak,maintenance',
            'lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_maintenance_terakhir' => 'nullable|date',
            'tanggal_maintenance_selanjutnya' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['kategori'] = $kategori;

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $data['gambar'] = $gambar->storeAs('peralatan', $namaFile, 'public');
        }

        BiayaPeralatan::create($data);

        return redirect()->route('admin.biaya-peralatan.index', $kategori)
            ->with('success', 'Data peralatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($kategori, $id)
    {
        $peralatan = BiayaPeralatan::where('kategori', $kategori)->findOrFail($id);
        
        return view('admin.biayaperalatan.show', compact('peralatan', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kategori, $id)
    {
        $peralatan = BiayaPeralatan::where('kategori', $kategori)->findOrFail($id);
        
        return view('admin.biayaperalatan.edit', compact('peralatan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kategori, $id)
    {
        $peralatan = BiayaPeralatan::where('kategori', $kategori)->findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'nomor_seri' => 'nullable|string|max:255',
            'tahun_pembelian' => 'nullable|integer|min:1900|max:' . date('Y'),
            'harga_beli' => 'required|numeric|min:0',
            'biaya_operasional' => 'required|numeric|min:0',
            'biaya_perawatan' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,tidak_aktif,rusak,maintenance',
            'lokasi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_maintenance_terakhir' => 'nullable|date',
            'tanggal_maintenance_selanjutnya' => 'nullable|date',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($peralatan->gambar && Storage::disk('public')->exists($peralatan->gambar)) {
                Storage::disk('public')->delete($peralatan->gambar);
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $data['gambar'] = $gambar->storeAs('peralatan', $namaFile, 'public');
        }

        $peralatan->update($data);

        return redirect()->route('admin.biaya-peralatan.index', $kategori)
            ->with('success', 'Data peralatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kategori, $id)
    {
        $peralatan = BiayaPeralatan::where('kategori', $kategori)->findOrFail($id);

        // Delete image if exists
        if ($peralatan->gambar && Storage::disk('public')->exists($peralatan->gambar)) {
            Storage::disk('public')->delete($peralatan->gambar);
        }

        $peralatan->delete();

        return redirect()->route('admin.biaya-peralatan.index', $kategori)
            ->with('success', 'Data peralatan berhasil dihapus');
    }

    /**
     * Update status peralatan
     */
    public function updateStatus(Request $request, $kategori, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,tidak_aktif,rusak,maintenance'
        ]);

        $peralatan = BiayaPeralatan::where('kategori', $kategori)->findOrFail($id);
        $peralatan->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status peralatan berhasil diperbarui');
    }

    /**
     * Get peralatan by status for statistics
     */
    public function getStatistik($kategori)
    {
        $statistik = BiayaPeralatan::where('kategori', $kategori)
            ->selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->get();

        return response()->json($statistik);
    }

    /**
     * Export data peralatan
     */
    public function export($kategori)
    {
        $peralatan = BiayaPeralatan::where('kategori', $kategori)->get();
        
        // Implementasi export sesuai kebutuhan (Excel, PDF, dll)
        // Untuk sekarang return JSON
        return response()->json($peralatan);
    }
}