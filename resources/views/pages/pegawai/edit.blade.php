@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold mb-4">Edit Data Pegawai</h1>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('pages.pegawai.form')
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection