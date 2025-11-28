@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Data Absensi</h1>
            <a href="{{ route('absensi.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Absensi
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>ID Badge</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal Absensi</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Remarks</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($absensi->currentPage() - 1) * $absensi->perPage() }}</td>
                                    <td>{{ $item->pegawai->id_badge ?? '-' }}</td> 
                                    <td>{{ $item->pegawai->nama ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_absensi)->format('d F Y') }}</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success fw-bold">{{ $item->waktu_masuk }}</span>
                                    </td>
                                    <td>
                                        @if($item->waktu_keluar)
                                            <span class="badge bg-danger-subtle text-danger fw-bold">{{ $item->waktu_keluar }}</span>
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill p-2 
                                            @if($item->keterangan == 'Hadir') 
                                                bg-success 
                                            @elseif($item->keterangan == 'Sakit') 
                                                bg-warning text-dark 
                                            @else 
                                                bg-danger 
                                            @endif">
                                            {{ $item->keterangan }}
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        {{-- TOMBOL REKAP BULANAN PEGAWAI --}}
                                        <a href="{{ route('timesheet.show', ['id_pegawai' => $item->id_pegawai]) }}" 
                                            class="btn btn-sm btn-primary me-1" title="Lihat Rekap Bulanan Pegawai">
                                            <i class="bi bi-calendar-check"></i> Rekap
                                        </a>

                                        {{-- TOMBOL EDIT LOG HARIAN --}}
                                        <a href="{{ route('absensi.edit', $item->id_absensi) }}" class="btn btn-sm btn-info text-white me-1" title="Edit Log Harian">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        {{-- TOMBOL HAPUS LOG HARIAN --}}
                                        <form action="{{ route('absensi.destroy', $item->id_absensi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data absensi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Log Harian">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="bi bi-info-circle me-2"></i> Belum ada data absensi yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Link Pagination --}}
                <div class="mt-3">
                    {{ $absensi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection