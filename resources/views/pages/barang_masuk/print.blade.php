<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk - PIS Marine</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header img {
            width: 70px;
            margin-bottom: 5px;
        }
        h2 {
            margin: 5px 0 0 0;
            font-size: 18px;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: center;
        }
        th {
            background: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logopis.png') }}" alt="Logo PIS">
        <h2>LAPORAN BARANG MASUK</h2>
        <p>PT PIS MARINE</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah</th>
                <th>Lokasi</th>
                <th>Diterima Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasuk as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->lokasi ?? '-' }}</td>
                <td>{{ $item->pegawai->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Barang Masuk: {{ $totalMasuk }}</p>

    <div class="footer">
        <p>Dicetak oleh: <strong>{{ $admin }}</strong></p>
        <p>Tanggal Cetak: {{ now()->format('d F Y, H:i') }}</p>
    </div>

</body>
</html>
