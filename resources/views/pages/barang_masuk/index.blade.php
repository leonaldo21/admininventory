@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">📦 Barang Masuk</h1>
    <div>
        <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Data
        </a>
        <a href="{{ route('barang_masuk.print') }}" target="_blank" class="btn btn-outline-primary">
            <i class="bi bi-printer-fill me-2"></i>Cetak Laporan
        </a>
    </div>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px">ID</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Lokasi</th>
                        <th>Diterima Oleh</th>
                        <th style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangMasuk as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item->id_barang_masuk ?? '-' }}</span></td>

                            {{-- Relasi barang --}}
                            <td class="text-start">
                                {{ optional($item->barang)->nama_barang ?? '-' }}
                            </td>

                            {{-- jumlah --}}
                            <td><span class="badge bg-success">{{ $item->jumlah ?? 0 }}</span></td>

                            {{-- tanggal --}}
                            <td>
                                {{ $item->tanggal_masuk ? \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') : '-' }}
                            </td>

                            {{-- lokasi --}}
                            <td>{{ $item->lokasi ?? '-' }}</td>

                            {{-- relasi pegawai atau nama langsung --}}
                            <td>
                                {{ optional($item->pegawai)->nama_pegawai ?? $item->diterima_oleh ?? '-' }}
                            </td>

                            {{-- aksi --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('barang_masuk.edit', ['barang_masuk' => $item->id_barang_masuk]) }}" 
                                       class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('barang_masuk.destroy', ['barang_masuk' => $item->id_barang_masuk]) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('PERINGATAN: Menghapus akan mengurangi stok. Lanjutkan?')">
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
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data barang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if (method_exists($barangMasuk, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $barangMasuk->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
