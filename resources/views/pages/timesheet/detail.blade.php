@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fw-bold mb-3">Detail Timesheet Pegawai</h1>
        
        <div class="alert alert-info py-2 shadow-sm border-0">
            <h5 class="mb-1">Pegawai: <strong class="text-primary">{{ $pegawai->nama }}</strong></h5>
            <p class="mb-0">ID Badge: <strong>{{ $pegawai->id_badge }}</strong></p>
        </div>

        {{-- Form Filter Bulan dan Tahun --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('timesheet.show', $pegawai->id_pegawai) }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" 
                                    {{ $bulan == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::createFromDate(null, $m, null)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select name="tahun" id="tahun" class="form-select">
                            @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100"><i class="bi bi-filter"></i> Filter Data</button>
                    </div>
                </form>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Absensi Bulan {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}</h3>

        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Keterangan</th>
                                <th>Durasi Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detailAbsensi as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_absensi)->format('d F Y') }}</td>
                                    <td><span class="badge bg-success-subtle text-success">{{ $item->waktu_masuk }}</span></td>
                                    <td>
                                        @if($item->waktu_keluar)
                                            <span class="badge bg-danger-subtle text-danger">{{ $item->waktu_keluar }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill p-2 
                                            @if($item->keterangan == 'Hadir') bg-success 
                                            @elseif($item->keterangan == 'Sakit') bg-warning text-dark 
                                            @else bg-danger 
                                            @endif">
                                            {{ $item->keterangan }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->waktu_masuk && $item->waktu_keluar)
                                            @php
                                                $masuk = \Carbon\Carbon::parse($item->tanggal_absensi . ' ' . $item->waktu_masuk);
                                                $keluar = \Carbon\Carbon::parse($item->tanggal_absensi . ' ' . $item->waktu_keluar);
                                                // Handle kasus jika waktu keluar terjadi pada hari berikutnya
                                                if ($keluar->lessThan($masuk)) {
                                                    $keluar->addDay();
                                                }
                                                $durasi = $keluar->diff($masuk)->format('%h jam %i menit');
                                            @endphp
                                            {{ $durasi }}
                                        @else
                                            <span class="text-muted">Belum Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Tidak ada data absensi pada bulan ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('timesheet.index') }}" class="btn btn-secondary mt-3">Kembali ke Rekapitulasi</a>
            </div>
        </div>
    </div>
@endsection
