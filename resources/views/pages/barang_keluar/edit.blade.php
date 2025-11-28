@extends('layouts.app')
@section('content')
<div class="container">
<h1 class="fw-bold mb-4">Edit Barang Keluar</h1>
<div class="card shadow-sm border-0">
<div class="card-body">
{{-- Pastikan nama variabel di controller (BarangKeluar $barangkeluar) sesuai --}}
<form action="{{ route('barang_keluar.update', $barangkeluar->id_keluar) }}" method="POST">
@csrf
@method('PUT')

                {{-- Form input di-include dari form.blade.php --}}
                @include('pages.barang_keluar.form')
                
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('barang_keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection