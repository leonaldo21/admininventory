@extends('layouts.app')
@section('content')
<div class="container">
<h1 class="fw-bold mb-4">Tambah Barang Keluar</h1>
<div class="card shadow-sm border-0">
<div class="card-body">
<form action="{{ route('barang_keluar.store') }}" method="POST">
@csrf
{{-- Form input di-include dari form.blade.php --}}
@include('pages.barang_keluar.form')

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang_keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection