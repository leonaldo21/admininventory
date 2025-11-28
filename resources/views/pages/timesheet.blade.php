@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        Timesheet Pegawai
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>EMP001</td>
                    <td>Budi Santoso</td>
                    <td>Foreman</td>
                    <td>2025-09-01</td>
                    <td>08:00</td>
                    <td>17:00</td>
                </tr>
                <tr>
                    <td>EMP002</td>
                    <td>Siti Aminah</td>
                    <td>Helper</td>
                    <td>2025-09-01</td>
                    <td>08:30</td>
                    <td>17:15</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
