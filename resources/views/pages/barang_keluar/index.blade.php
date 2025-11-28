@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">🚚 Barang Keluar</h1>
    <div>
        {{-- Tombol Cetak --}}
        @if(Route::has('barang_keluar.print'))
            <a href="{{ route('barang_keluar.print') }}" target="_blank" class="btn btn-outline-success me-2">
                <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
            </a>
        @endif

        {{-- Tombol Tambah --}}
        @if(Route::has('barang_keluar.create'))
            <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill me-1"></i> Tambah Data
            </a>
        @endif
    </div>
</div>

{{-- Alert --}}
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

{{-- Card --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Keluar</th>
                        <th>Lokasi</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangKeluar ?? [] as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item->id_keluar ?? '-' }}</span></td>
                            <td class="text-start">{{ $item->barang->nama_barang ?? '-' }}</td>
                            <td><span class="badge bg-danger">{{ $item->jumlah ?? 0 }}</span></td>
                            <td>{{ $item->tanggal_keluar ? \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') : '-' }}</td>
                            <td>{{ $item->lokasi ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if(isset($item->id_keluar))
                                        <a href="{{ route('barang_keluar.edit', $item->id_keluar) }}" class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('barang_keluar.destroy', $item->id_keluar) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data barang keluar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($barangKeluar) && method_exists($barangKeluar, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $barangKeluar->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
