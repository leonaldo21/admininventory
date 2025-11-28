<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    private $roles = ['helper', 'supervisor', 'foreman', 'insulator', 'carpenter'];

    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pages.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        $roles = $this->roles;
        return view('pages.pegawai.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik_ktp' => 'required|string|unique:pegawai|max:255',
            'no_kk' => 'nullable|string|max:255',
            'no_bpjs' => 'nullable|string|max:255',
            'no_jmo' => 'nullable|string|max:255',
            'no_npwp' => 'nullable|string|max:255',
            'badge_id' => 'required|string|unique:pegawai|max:255',
            'role' => ['required', Rule::in($this->roles)],
            'dokumen_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('dokumen_file')) {
            $validated['dokumen'] = $request->file('dokumen_file')->store('public/dokumen_pegawai');
        }

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        $roles = $this->roles;
        return view('pages.pegawai.edit', compact('pegawai', 'roles'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik_ktp' => [
                'required',
                'string',
                Rule::unique('pegawai')->ignore($pegawai->id_pegawai, 'id_pegawai'),
            ],
            'no_kk' => 'nullable|string|max:255',
            'no_bpjs' => 'nullable|string|max:255',
            'no_jmo' => 'nullable|string|max:255',
            'no_npwp' => 'nullable|string|max:255',
            'badge_id' => [
                'required',
                'string',
                Rule::unique('pegawai')->ignore($pegawai->id_pegawai, 'id_pegawai'),
            ],
            'role' => ['required', Rule::in($this->roles)],
            'dokumen_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('dokumen_file')) {
            // Hapus dokumen lama kalau ada
            if ($pegawai->dokumen && Storage::exists($pegawai->dokumen)) {
                Storage::delete($pegawai->dokumen);
            }
            $validated['dokumen'] = $request->file('dokumen_file')->store('public/dokumen_pegawai');
        }

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->dokumen && Storage::exists($pegawai->dokumen)) {
            Storage::delete($pegawai->dokumen);
        }
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function downloadDokumen(Pegawai $pegawai)
    {
        if ($pegawai->dokumen && Storage::exists($pegawai->dokumen)) {
            $fileName = 'dokumen_' . $pegawai->nik_ktp . '.pdf';
            return Storage::download($pegawai->dokumen, $fileName);
        }

        return redirect()->back()->with('error', 'File dokumen tidak ditemukan.');
    }
}
