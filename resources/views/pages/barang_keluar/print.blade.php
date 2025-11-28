<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar - PT PIS</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 35px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .header img {
            width: 90px;
            height: auto;
            margin-right: 20px;
        }

        .company-info {
            flex: 1;
            text-align: center;
        }
        .company-info h1 {
            font-size: 22px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .company-info p {
            margin: 3px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background: #f3f3f3;
            text-transform: uppercase;
        }
        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .summary {
            margin-top: 25px;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 13px;
        }
        .footer small {
            color: #666;
        }

        .no-print {
            margin-top: 30px;
            text-align: center;
        }
        .no-print button, .no-print a {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            font-size: 14px;
        }
        .no-print button {
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .no-print a {
            color: #333;
        }

        @media print {
            .no-print { display: none; }
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }
            tr { page-break-inside: avoid; }
            body { margin: 20mm; }
            img { visibility: visible !important; display: block !important; }
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ asset('images/pislogo.png') }}" alt="Logo PIS">
        <div class="company-info">
            <h1>PT PIS</h1>
            <p><strong>Laporan Barang Keluar</strong></p>
            <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Keluar</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
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

    <div class="summary">
        <p><strong>Total Barang Keluar:</strong> {{ $totalKeluar }}</p>
    </div>

    <div class="footer">
        <p>Dicetak oleh: <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong></p>
        <small>© {{ date('Y') }} PT PIS — Sistem Inventaris Barang</small>
    </div>

    <div class="no-print">
        <button onclick="window.print()">🖨️ Cetak Halaman</button>
        <a href="{{ route('barang_keluar.index') }}">⬅️ Kembali</a>
    </div>

</body>
</html>
