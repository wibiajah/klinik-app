<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::latest()->get();
        return view('admin.perawat.index', compact('perawats'));
    }

    public function create()
    {
        return view('admin.perawat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perawat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tingkat_pendidikan' => 'required|in:D3 Keperawatan,S1 Keperawatan,Ners',
            'no_str' => 'required|string|unique:perawat,no_str',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:perawat,email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'boolean'
        ]);

        $data = $request->all();
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perawat-photos', 'public');
        }

        // Handle jadwal kerja
        $jadwal = [];
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        
        foreach ($hari as $h) {
            if ($request->has("jadwal_{$h}") && $request->input("jadwal_{$h}")) {
                $jadwal[$h] = [
                    'jam_mulai' => $request->input("jam_mulai_{$h}"),
                    'jam_selesai' => $request->input("jam_selesai_{$h}"),
                    'shift' => $request->input("shift_{$h}") // pagi, siang, malam
                ];
            }
        }
        
        $data['jadwal_kerja'] = $jadwal;

        Perawat::create($data);

        return redirect()->route('admin.data-perawat.index')
                        ->with('success', 'Data perawat berhasil ditambahkan');
    }

    public function show(Perawat $perawat)
    {
        return view('admin.perawat.show', compact('perawat'));
    }

    public function edit(Perawat $perawat)
    {
        return view('admin.perawat.edit', compact('perawat'));
    }

    public function update(Request $request, Perawat $perawat)
    {
        $request->validate([
            'nama_perawat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tingkat_pendidikan' => 'required|in:D3 Keperawatan,S1 Keperawatan,Ners',
            'no_str' => 'required|string|unique:perawat,no_str,' . $perawat->id_perawat . ',id_perawat',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:perawat,email,' . $perawat->id_perawat . ',id_perawat',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_aktif' => 'boolean'
        ]);

        $data = $request->all();
        
        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($perawat->foto) {
                Storage::disk('public')->delete($perawat->foto);
            }
            $data['foto'] = $request->file('foto')->store('perawat-photos', 'public');
        }

        // Handle jadwal kerja
        $jadwal = [];
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        
        foreach ($hari as $h) {
            if ($request->has("jadwal_{$h}") && $request->input("jadwal_{$h}")) {
                $jadwal[$h] = [
                    'jam_mulai' => $request->input("jam_mulai_{$h}"),
                    'jam_selesai' => $request->input("jam_selesai_{$h}"),
                    'shift' => $request->input("shift_{$h}")
                ];
            }
        }
        
        $data['jadwal_kerja'] = $jadwal;

        $perawat->update($data);

        return redirect()->route('admin.data-perawat.index')
                        ->with('success', 'Data perawat berhasil diperbarui');
    }

    public function destroy(Perawat $perawat)
    {
        // Delete photo if exists
        if ($perawat->foto) {
            Storage::disk('public')->delete($perawat->foto);
        }
        
        $perawat->delete();

        return redirect()->route('admin.data-perawat.index')
                        ->with('success', 'Data perawat berhasil dihapus');
    }
}