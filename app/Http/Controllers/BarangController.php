<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * 📦 Menampilkan daftar barang (Master Data)
     */
    public function index()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->paginate(10);
        return view('pages.barang.index', compact('barang'));
    }

    /**
     * ➕ Menampilkan form tambah barang baru
     */
    public function create()
    {
        $barang = new Barang();
        return view('pages.barang.create', compact('barang'));
    }

    /**
     * 💾 Menyimpan barang baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'     => 'required|string|max:255|unique:barang,nama_barang',
            'serial_number'   => 'nullable|string|max:100',
            'kategori'        => 'nullable|string|max:255',
            'satuan'          => 'nullable|string|max:50',
            'quantity_total'  => 'required|integer|min:0',
            'remarks'         => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            Barang::create([
                'nama_barang'     => $validated['nama_barang'],
                'serial_number'   => $validated['serial_number'] ?? null,
                'kategori'        => $validated['kategori'] ?? '-',
                'satuan'          => $validated['satuan'] ?? '-',
                'quantity_total'  => $validated['quantity_total'],
                'remarks'         => $validated['remarks'] ?? null,
            ]);

            DB::commit();
            return redirect()
                ->route('barang.index')
                ->with('success', 'Barang baru berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan barang. Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * ✏️ Menampilkan form edit barang
     */
    public function edit(Barang $barang)
    {
        return view('pages.barang.edit', compact('barang'));
    }

    /**
     * 🔁 Memperbarui data barang
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang'     => 'required|string|max:255|unique:barang,nama_barang,' . $barang->id_barang . ',id_barang',
            'serial_number'   => 'nullable|string|max:100',
            'kategori'        => 'nullable|string|max:255',
            'satuan'          => 'nullable|string|max:50',
            'quantity_total'  => 'required|integer|min:0',
            'remarks'         => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $barang->update([
                'nama_barang'     => $validated['nama_barang'],
                'serial_number'   => $validated['serial_number'] ?? null,
                'kategori'        => $validated['kategori'] ?? '-',
                'satuan'          => $validated['satuan'] ?? '-',
                'quantity_total'  => $validated['quantity_total'],
                'remarks'         => $validated['remarks'] ?? null,
            ]);

            DB::commit();
            return redirect()
                ->route('barang.index')
                ->with('success', 'Data barang berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data. Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * 🗑️ Menghapus barang dari database
     */
    public function destroy(Barang $barang)
    {
        DB::beginTransaction();
        try {
            if ($barang->quantity_total > 0) {
                return back()
                    ->with('error', 'Tidak dapat menghapus. Stok barang masih ada (' . $barang->quantity_total . ').');
            }

            $barang->delete();
            DB::commit();

            return redirect()
                ->route('barang.index')
                ->with('success', 'Barang berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Gagal menghapus barang. Pesan error: ' . $e->getMessage());
        }
    }

    /**
     * 🖨️ Menampilkan halaman print / laporan barang
     */
    public function print()
    {
        $barang = Barang::orderBy('nama_barang', 'asc')->get();

        // Total jumlah item dan total kuantitas
        $totalBarang = $barang->count();
        $totalQuantity = $barang->sum('quantity_total');

        // Kirim data ke view print.blade.php
        return view('pages.barang.print', compact('barang', 'totalBarang', 'totalQuantity'));
    }
}
