<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimesheetController extends Controller
{
    /**
     * Menampilkan daftar rekapitulasi kehadiran (Bisa dihapus jika tidak digunakan)
     */
    public function index()
    {
        // Mendapatkan total kehadiran unik per pegawai
        $rekapAbsensi = Absensi::select('id_pegawai', 
                                  DB::raw('COUNT(DISTINCT tanggal_absensi) as total_hari_hadir'))
            ->groupBy('id_pegawai')
            ->get();
            
        $rekapAbsensi->load('pegawai');

        return view('pages.timesheet.index', compact('rekapAbsensi')); 
    }

    /**
     * Menampilkan detail absensi per pegawai (Rekap Bulanan)
     * Dipanggil dari tombol "Rekap" di halaman absensi.index
     */
    public function show($id_pegawai, Request $request)
    {
        $pegawai = Pegawai::findOrFail($id_pegawai);
        
        // Ambil tahun dan bulan dari request, default ke bulan dan tahun saat ini
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan', date('m'));

        // Ambil semua data absensi untuk pegawai tersebut di bulan/tahun yang dipilih
        $detailAbsensi = Absensi::where('id_pegawai', $id_pegawai)
            ->whereYear('tanggal_absensi', $tahun)
            ->whereMonth('tanggal_absensi', $bulan)
            ->orderBy('tanggal_absensi', 'asc')
            ->get();

        return view('pages.timesheet.detail', compact('pegawai', 'detailAbsensi', 'tahun', 'bulan'));
    }
}