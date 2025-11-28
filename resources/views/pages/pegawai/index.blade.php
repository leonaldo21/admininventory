@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">👨‍💼 Data Pegawai</h1>
    <div>
        {{-- Tombol Cetak --}}
        @if(Route::has('pegawai.print'))
            <a href="{{ route('pegawai.print') }}" target="_blank" class="btn btn-outline-success me-2">
                <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
            </a>
        @endif

        {{-- Tombol Tambah --}}
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Data
        </a>
    </div>
</div>

{{-- Notifikasi --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Card Table --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th>Nama</th>
                        <th>NIK KTP</th>
                        <th>Badge ID</th>
                        <th>Role</th>
                        <th>Dokumen</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawai as $p)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $p->id_pegawai }}</span></td>
                            <td class="text-start">{{ $p->nama }}</td>
                            <td>{{ $p->nik_ktp }}</td>
                            <td><span class="badge bg-info">{{ $p->badge_id }}</span></td>
                            <td><span class="badge bg-dark">{{ ucfirst($p->role) }}</span></td>
                            <td>
                                @if($p->dokumen)
                                    <a href="{{ route('pegawai.download.dokumen', $p->id_pegawai) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Unduh
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pegawai.edit', $p->id_pegawai) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-person-x fs-3 d-block mb-2"></i>
                                Belum ada data pegawai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if (method_exists($pegawai, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $pegawai->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
