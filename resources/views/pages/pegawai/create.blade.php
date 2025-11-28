@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Tambah Data Pegawai</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Form input di-include dari file form.blade.php --}}
                @include('pages.pegawai.form')

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
