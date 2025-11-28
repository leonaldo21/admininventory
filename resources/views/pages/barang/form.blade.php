@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 fw-bold">Tambah Barang</h4>

    {{-- ALERT PESAN SUKSES / ERROR --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM TAMBAH BARANG --}}
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
            <input 
                type="text" 
                class="form-control @error('nama_barang') is-invalid @enderror" 
                id="nama_barang" 
                name="nama_barang" 
                value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" 
                placeholder="Masukkan nama barang" 
                required
            >
            @error('nama_barang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="serial_number" class="form-label fw-semibold">Serial Number</label>
            <input 
                type="text" 
                class="form-control @error('serial_number') is-invalid @enderror" 
                id="serial_number" 
                name="serial_number" 
                value="{{ old('serial_number', $barang->serial_number ?? '') }}" 
                placeholder="Masukkan serial number (opsional)"
            >
            @error('serial_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity_total" class="form-label fw-semibold">Total Quantity</label>
            <input 
                type="number" 
                class="form-control @error('quantity_total') is-invalid @enderror" 
                id="quantity_total" 
                name="quantity_total" 
                value="{{ old('quantity_total', $barang->quantity_total ?? '') }}" 
                placeholder="Masukkan jumlah total barang" 
                required
                min="1"
            >
            @error('quantity_total')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
