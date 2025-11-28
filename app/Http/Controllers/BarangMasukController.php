<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar barang masuk
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['barang', 'pegawai'])
            ->orderBy('id_barang_masuk', 'desc')
            ->paginate(10);

        return view('pages.barang_masuk.index', compact('barangMasuk'));
    }

    /**
     * Form tambah barang masuk
     */
    public function create()
    {
        $barang = Barang::all();
        $pegawai = Pegawai::all();

        return view('pages.barang_masuk.create', compact('barang', 'pegawai'));
    }

    /**
     * Simpan barang masuk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang'     => 'required|exists:barang,id_barang',
            'jumlah'        => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'lokasi'        => 'nullable|string|max:255',
            'diterima_oleh' => 'required|exists:pegawai,id_pegawai',
        ]);

        DB::beginTransaction();
        try {
            BarangMasuk::create($request->all());

            Barang::where('id_barang', $request->id_barang)
                ->increment('quantity_total', $request->jumlah);

            DB::commit();
            return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data. Error: ' . $e->getMessage());
        }
    }

    /**
     * Form edit barang masuk
     */
    public function edit(BarangMasuk $barang_masuk)
    {
        $barang = Barang::all();
        $pegawai = Pegawai::all();

        return view('pages.barang_masuk.edit', compact('barang_masuk', 'barang', 'pegawai'));
    }

    /**
     * Update barang masuk
     */
    public function update(Request $request, BarangMasuk $barang_masuk)
    {
        $request->validate([
            'id_barang'     => 'required|exists:barang,id_barang',
            'jumlah'        => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'lokasi'        => 'nullable|string|max:255',
            'diterima_oleh' => 'required|exists:pegawai,id_pegawai',
        ]);

        DB::beginTransaction();
        try {
            $old_jumlah = $barang_masuk->jumlah;
            $id_barang_lama = $barang_masuk->id_barang;
            $id_barang_baru = $request->id_barang;

            $barang_masuk->update($request->all());

            if ($id_barang_lama == $id_barang_baru) {
                $diff_jumlah = $request->jumlah - $old_jumlah;
                Barang::where('id_barang', $id_barang_lama)
                    ->increment('quantity_total', $diff_jumlah);
            } else {
                Barang::where('id_barang', $id_barang_lama)
                    ->decrement('quantity_total', $old_jumlah);
                Barang::where('id_barang', $id_barang_baru)
                    ->increment('quantity_total', $request->jumlah);
            }

            DB::commit();
            return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data. Error: ' . $e->getMessage());
        }
    }

    /**
     * Hapus barang masuk
     */
    public function destroy(BarangMasuk $barang_masuk)
    {
        DB::beginTransaction();
        try {
            $jumlah = $barang_masuk->jumlah;
            $id_barang = $barang_masuk->id_barang;

            $barang_masuk->delete();

            Barang::where('id_barang', $id_barang)
                ->decrement('quantity_total', $jumlah);

            DB::commit();
            return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data. Error: ' . $e->getMessage());
        }
    }

    /**
     * 🖨️ Cetak laporan barang masuk
     */
    public function print()
    {
        $barangMasuk = BarangMasuk::with(['barang', 'pegawai'])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalMasuk = $barangMasuk->sum('jumlah');
        $admin = Auth::user()->name ?? 'Admin Tidak Dikenal';

        return view('pages.barang_masuk.print', compact('barangMasuk', 'totalMasuk', 'admin'));
    }
}
