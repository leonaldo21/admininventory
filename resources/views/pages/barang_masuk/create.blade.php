@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Tambah Barang Masuk</h1>

    {{-- Tampilkan pesan error atau sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('barang_masuk.store') }}" method="POST">
                @csrf
                @include('pages.barang_masuk.form')

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang_masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection