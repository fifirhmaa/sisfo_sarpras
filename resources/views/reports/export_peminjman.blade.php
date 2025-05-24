<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Laporan Peminjaman</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $borrow)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $borrow->user->name ?? '-' }}</td>
                    <td>{{ $borrow->item->name ?? '-' }}</td>
                    <td>{{ $borrow->quantity }}</td>
                    <td>{{ $borrow->borrow_date }}</td>
                    <td>{{ $borrow->is_approved == 1 ? 'Disetujui' : 'Tidak' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
