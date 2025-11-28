@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fw-bold mb-4">Rekapitulasi Timesheet (Kehadiran Pegawai)</h1>
        
        <p class="text-muted">Ringkasan total hari kehadiran unik per pegawai.</p>

        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>ID Badge</th>
                                <th>Nama Pegawai</th>
                                <th>Total Hari Hadir (Unik)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapAbsensi as $rekap)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rekap->pegawai->id_badge ?? '-' }}</td>
                                    <td>{{ $rekap->pegawai->nama ?? 'Pegawai Tidak Ditemukan' }}</td>
                                    <td>
                                        <span class="badge bg-primary fs-6">{{ $rekap->total_hari_hadir }} Hari</span>
                                    </td>
                                    <td class="text-nowrap">
                                        {{-- Link ke halaman detail (Bulanan) --}}
                                        <a href="{{ route('timesheet.show', ['id_pegawai' => $rekap->id_pegawai]) }}" 
                                            class="btn btn-sm btn-outline-info" title="Lihat Detail Absensi Bulanan">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data absensi untuk direkap.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
