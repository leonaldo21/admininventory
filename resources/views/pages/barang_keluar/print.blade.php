<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { font-size: 14px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="text-center mb-4">
        <h4 class="fw-bold">PT PIS Marine</h4>
        <h5>Laporan Barang Keluar</h5>
        <p>Tanggal Cetak: {{ now()->format('d M Y, H:i') }}</p>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Tanggal Keluar</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($barangKeluar as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}</td>
                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p><strong>Total Barang Keluar:</strong> {{ $totalKeluar }}</p>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success">Print Halaman Ini</button>
        <a href="{{ route('barang_keluar.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>
