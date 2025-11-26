<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::latest()->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'spesialisasi' => 'required|string|max:255',
            'no_str' => 'required|string|unique:dokter,no_str',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:dokter,email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'boolean'
        ]);

        $data = $request->all();
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dokter-photos', 'public');
        }

        // Handle jadwal praktik
        $jadwal = [];
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        
        foreach ($hari as $h) {
            if ($request->has("jadwal_{$h}") && $request->input("jadwal_{$h}")) {
                $jadwal[$h] = [
                    'jam_mulai' => $request->input("jam_mulai_{$h}"),
                    'jam_selesai' => $request->input("jam_selesai_{$h}")
                ];
            }
        }
        
        $data['jadwal_praktik'] = $jadwal;

        Dokter::create($data);

        return redirect()->route('admin.data-dokter.index')
                        ->with('success', 'Data dokter berhasil ditambahkan');
    }

    public function show(Dokter $dokter)
    {
        return view('admin.dokter.show', compact('dokter'));
    }

    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'spesialisasi' => 'required|string|max:255',
            'no_str' => 'required|string|unique:dokter,no_str,' . $dokter->id_dokter . ',id_dokter',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:dokter,email,' . $dokter->id_dokter . ',id_dokter',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'boolean'
        ]);

        $data = $request->all();
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($dokter->foto) {
                Storage::disk('public')->delete($dokter->foto);
            }
            $data['foto'] = $request->file('foto')->store('dokter-photos', 'public');
        }

        // Handle jadwal praktik
        $jadwal = [];
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        
        foreach ($hari as $h) {
            if ($request->has("jadwal_{$h}") && $request->input("jadwal_{$h}")) {
                $jadwal[$h] = [
                    'jam_mulai' => $request->input("jam_mulai_{$h}"),
                    'jam_selesai' => $request->input("jam_selesai_{$h}")
                ];
            }
        }
        
        $data['jadwal_praktik'] = $jadwal;

        $dokter->update($data);

        return redirect()->route('admin.data-dokter.index')
                        ->with('success', 'Data dokter berhasil diperbarui');
    }

    public function destroy(Dokter $dokter)
    {
        // Delete photo if exists
        if ($dokter->foto) {
            Storage::disk('public')->delete($dokter->foto);
        }
        
        $dokter->delete();

        return redirect()->route('admin.data-dokter.index')
                        ->with('success', 'Data dokter berhasil dihapus');
    }
}