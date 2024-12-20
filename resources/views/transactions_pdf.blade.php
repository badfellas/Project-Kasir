<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .text-center {
            text-align: center;
        }

        h5 {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        h6 {
            font-size: 16px;
            margin-top: 5px;
        }

        .mt-3 {
            margin-top: 30px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 14px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center">
            <h5>Laporan Transaksi</h5>
            <h6>Toko Kami</h6>
        </div>

        <div class="mt-3">
            <h6 class="header-title">Detail Transaksi</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Waktu Transaksi</th>
                        <th scope="col">Nama Petugas</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Bayar</th>
                        <th scope="col">Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at }}</td>
                        <!-- Pastikan nama petugas terbaca dengan benar -->
                        <td>{{ optional($transaction->user)->nama ?? 'Nama Petugas Tidak Ditemukan' }}</td>
                        <td>{{ $transaction->nama_pembeli }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->total_harga }}</td>
                        <td>{{ $transaction->bayar }}</td>
                        <td>{{ $transaction->kembalian }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>&copy; 2024 Toko Kami. Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>

</body>

</html>
