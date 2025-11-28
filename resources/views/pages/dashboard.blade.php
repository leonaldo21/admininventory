@extends('layouts.app')

@section('content')
    <h2 class="mb-4 fw-bold">📊 Dashboard</h2>

    {{-- Statistik Utama --}}
    <div class="row g-4 mb-4">
        {{-- Pegawai --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Jumlah Pegawai</h6>
                            <h3 class="fw-bold">{{ $totalPegawai ?? 0 }}</h3>
                        </div>
                        <div class="text-primary fs-2">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <hr>
                    <ul class="list-unstyled small mb-0 text-muted">
                        <li>👷 Helper: {{ $pegawaiRole['helper'] ?? 0 }}</li>
                        <li>👨‍💼 Supervisor: {{ $pegawaiRole['supervisor'] ?? 0 }}</li>
                        <li>🛠 Foreman: {{ $pegawaiRole['foreman'] ?? 0 }}</li>
                        <li>🔥 Insulator: {{ $pegawaiRole['insulator'] ?? 0 }}</li>
                        <li>🔨 Carpenter: {{ $pegawaiRole['carpenter'] ?? 0 }}</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Barang Masuk --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-light-success">
                <div class="card-body text-center">
                    <div class="text-success fs-1 mb-2">
                        <i class="bi bi-box-arrow-in-down"></i>
                    </div>
                    <h6 class="text-muted">Barang Masuk Hari Ini</h6>
                    <h3 class="fw-bold text-success">{{ $barangMasukHariIni ?? 0 }}</h3>
                </div>
            </div>
        </div>

        {{-- Barang Keluar --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-light-danger">
                <div class="card-body text-center">
                    <div class="text-danger fs-1 mb-2">
                        <i class="bi bi-box-arrow-up"></i>
                    </div>
                    <h6 class="text-muted">Barang Keluar Hari Ini</h6>
                    <h3 class="fw-bold text-danger">{{ $barangKeluarHariIni ?? 0 }}</h3>
                </div>
            </div>
</div>

        {{-- Total Jam Kerja --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-light-primary">
                <div class="card-body text-center">
                    <div class="text-primary fs-1 mb-2">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h6 class="text-muted">Total Jam Kerja</h6>
                    <h3 class="fw-bold">{{ $totalJamKerja ?? 0 }}</h3>
                    <small class="text-muted">(Mingguan / Bulanan)</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekap Absensi --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-calendar-check"></i> Rekap Absensi Hari Ini
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Total Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapAbsensi as $absen)
                            <tr>
                                <td>{{ $absen->pegawai->nama }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $absen->jam_masuk }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-danger">
                                        {{ $absen->jam_keluar }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $absen->total_jam }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data absensi hari ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection