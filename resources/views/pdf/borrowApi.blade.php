<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .period {
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div class="period">Periode: {{ $period }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Nama Peminjam</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Jumlah</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Kondisi Kembali</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $key => $borrow)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $borrow->borrow_date->format('d-m-Y') }}</td>
                    <td>{{ $borrow->user->name }}</td>
                    <td>{{ $borrow->item->name }}</td>
                    <td>{{ $borrow->item->code_item }}</td>
                    <td>{{ $borrow->quantity }}</td>
                    <td>{{ $borrow->purposes }}</td>
                    <td>{{ $borrow->status }}</td>
                    <td>
                        @if ($borrow->return)
                            {{ $borrow->return->condition }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($borrow->return)
                            {{ $borrow->return->return_date->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ $generated_at }}
    </div>
</body>

</html>
