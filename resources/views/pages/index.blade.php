@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="container">
    <h2 class="mb-3">📥 Data Barang Masuk</h2>
    <a href="{{ route('barang_masuk.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Barang Masuk
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Tanggal Masuk</th>
                        <th>Jumlah</th>
                        <th>Diterima Oleh</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangMasuk as $bm)
                        <tr>
                            <td>{{ $bm->id_barang_masuk }}</td>
                            <td>{{ $bm->barang->nama_barang ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d-m-Y') }}</td>
                            <td>{{ $bm->quantity_masuk }}</td>
                            <td>{{ $bm->penerima->nama ?? '-' }}</td>
                            <td>
                                <a href="{{ route('barang_masuk.edit', $bm->id_barang_masuk) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('barang_masuk.destroy', $bm->id_barang_masuk) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data barang masuk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
