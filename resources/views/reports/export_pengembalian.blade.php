<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengembalian</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Laporan Pengembalian</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>Kode Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $return)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $return->borrow_id }}</td>
                    <td>{{ $return->id }}</td>
                    <td>{{ $return->return_date }}</td>
                    <td>{{ $return->user->name ?? '-' }}</td>
                    <td>{{ $return->borrow->item->name ?? '-' }}</td>
                    <td>{{ $return->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
