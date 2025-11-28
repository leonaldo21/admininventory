@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fw-bold mb-4">Edit Barang: {{ $barang->nama_barang }}</h1>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('pages.barang.form')

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection