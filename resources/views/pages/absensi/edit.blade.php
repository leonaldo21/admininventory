@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fw-bold mb-4">Edit Data Absensi</h1>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('absensi.update', $absensi->id_absensi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('pages.absensi.form')
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
