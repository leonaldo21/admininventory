<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Menampilkan daftar absensi dengan pagination
     */
    public function index()
    {
        // Menggunakan pagination untuk performa yang lebih baik
        $absensi = Absensi::with('pegawai')
            ->latest()
            ->paginate(20); 
            
        return view('pages.absensi.index', compact('absensi'));
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        // Mempersiapkan objek kosong untuk form
        $absensi = new Absensi(); 
        return view('pages.absensi.create', compact('pegawai', 'absensi'));
    }

    /**
     * Menyimpan absensi baru dengan pengecekan limit harian
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pegawai'      => 'required|exists:pegawai,id_pegawai',
            'tanggal_absensi' => 'required|date',
            'waktu_masuk'     => 'required|date_format:H:i',
            'waktu_keluar'    => 'nullable|date_format:H:i|after:waktu_masuk', 
            'keterangan'      => 'required|string|max:50',
        ]);

        // Cek apakah pegawai sudah absen pada tanggal ini
        $existingAbsensi = Absensi::where('id_pegawai', $validated['id_pegawai'])
            ->whereDate('tanggal_absensi', $validated['tanggal_absensi'])
            ->exists();

        if ($existingAbsensi) {
            return redirect()->back()->withInput()
                ->with('error', 'Pegawai ini sudah melakukan absensi pada tanggal ini.');
        }

        Absensi::create($validated);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan');
    }

    public function edit(Absensi $absensi)
    {
        $pegawai = Pegawai::all();
        return view('pages.absensi.edit', compact('absensi', 'pegawai'));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $validated = $request->validate([
            'id_pegawai'      => 'required|exists:pegawai,id_pegawai',
            'tanggal_absensi' => 'required|date',
            'waktu_masuk'     => 'required|date_format:H:i',
            'waktu_keluar'    => 'nullable|date_format:H:i|after:waktu_masuk',
            'keterangan'      => 'required|string|max:50',
        ]);

        // Pengecekan unik saat update (kecuali data diri sendiri)
        $existingAbsensi = Absensi::where('id_pegawai', $validated['id_pegawai'])
            ->whereDate('tanggal_absensi', $validated['tanggal_absensi'])
            ->where('id_absensi', '!=', $absensi->id_absensi)
            ->exists();

        if ($existingAbsensi) {
            return redirect()->back()->withInput()
                ->with('error', 'Pegawai ini sudah memiliki data absensi lain pada tanggal tersebut.');
        }

        $absensi->update($validated);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus');
    }
}