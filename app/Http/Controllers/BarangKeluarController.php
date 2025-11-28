<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('barang')->orderBy('id_barang_keluar', 'desc')->paginate(10);
        return view('pages.barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('pages.barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($validated['id_barang']);

            // Pastikan stok cukup
            if ($barang->quantity_total < $validated['jumlah']) {
                return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
            }

            // Simpan data barang keluar
            BarangKeluar::create(array_merge($validated, [
                'kode_barang' => $barang->kode_barang ?? null,
                'nama_barang' => $barang->nama_barang ?? null,
                'satuan' => $barang->satuan ?? null,
            ]));

            // Kurangi stok di tabel barang
            $barang->decrement('quantity_total', $validated['jumlah']);

            DB::commit();
            return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil ditambahkan dan stok diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data. Error: ' . $e->getMessage());
        }
    }

    public function edit(BarangKeluar $barangkeluar)
    {
        $barang = Barang::all();
        return view('pages.barang_keluar.edit', compact('barangkeluar', 'barang'));
    }

    public function update(Request $request, BarangKeluar $barangkeluar)
    {
        $validated = $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $old_jumlah = $barangkeluar->jumlah;
            $id_barang_lama = $barangkeluar->id_barang;
            $id_barang_baru = $validated['id_barang'];

            // Update data keluar
            $barangkeluar->update($validated);

            // Update stok barang
            if ($id_barang_lama == $id_barang_baru) {
                $diff_jumlah = $validated['jumlah'] - $old_jumlah;
                Barang::where('id_barang', $id_barang_baru)
                    ->decrement('quantity_total', $diff_jumlah);
            } else {
                // Kembalikan stok lama
                Barang::where('id_barang', $id_barang_lama)
                    ->increment('quantity_total', $old_jumlah);

                // Kurangi stok baru
                Barang::where('id_barang', $id_barang_baru)
                    ->decrement('quantity_total', $validated['jumlah']);
            }

            DB::commit();
            return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil diperbarui dan stok diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data. Error: ' . $e->getMessage());
        }
    }

    public function destroy(BarangKeluar $barangkeluar)
    {
        DB::beginTransaction();
        try {
            $jumlah = $barangkeluar->jumlah;
            $id_barang = $barangkeluar->id_barang;

            $barangkeluar->delete();

            // Kembalikan stok karena transaksi keluar dihapus
            Barang::where('id_barang', $id_barang)->increment('quantity_total', $jumlah);

            DB::commit();
            return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil dihapus dan stok dikembalikan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data. Error: ' . $e->getMessage());
        }
    }
    /**
     * 🖨️ Menampilkan halaman print / laporan barang keluar
     */
    public function print()
    {
        $barangKeluar = \App\Models\BarangKeluar::with('barang')->orderBy('tanggal_keluar', 'desc')->get();
        $totalKeluar = $barangKeluar->sum('jumlah');

        return view('pages.barang_keluar.print', compact('barangKeluar', 'totalKeluar'));
    }

}
