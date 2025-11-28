@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">🏭 Master Data Barang</h1>
    <div class="d-flex align-items-center">
        <a href="{{ route('barang.create') }}" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Data
        </a>
        <a href="{{ route('barang.print') }}" target="_blank" class="btn btn-outline-success">
            <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
        </a>
    </div>
</div>

{{-- 🔔 Notifikasi --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- 📋 Card Table --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">ID</th>
                        <th>Nama Barang</th>
                        <th>Serial Number</th>
                        <th>Total Quantity</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $b)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $b->id_barang }}</span></td>
                            <td class="text-start">{{ $b->nama_barang }}</td>
                            <td>{{ $b->serial_number ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ $b->quantity_total }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('barang.edit', $b->id_barang) }}" 
                                       class="btn btn-sm btn-info text-white" title="Edit Barang">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('barang.destroy', $b->id_barang) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Barang">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-box fs-3 d-block mb-2"></i>
                                Belum ada data barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 📄 Pagination --}}
        @if (method_exists($barang, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $barang->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
