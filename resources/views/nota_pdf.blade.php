<!DOCTYPE html>
<html>

<head>
    <title>NOTA TOKO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            text-align: center;
            padding: 10px 15px;
        }

        h5, h6 {
            margin-bottom: 10px;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table th {
            font-weight: bold;
            background-color: #e9ecef;
        }

        .table td, .table th {
            border: 1px solid #ddd;
        }

        .table-light {
            background-color: #f9f9f9;
        }

        .center {
            text-align: center;
            margin-bottom: 30px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

        .table td {
            font-size: 14px;
        }

        .table th {
            font-size: 16px;
        }

        .section-title {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .total-summary {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .total-summary span {
            margin-right: 15px;
        }

    </style>
</head>

<body>

    <div class="center">
    <h5>NOTA {{ $transaction->no_nota }}</h5>
    <h6>Toko</h6>
    </div>


    <table class="table table-light">
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
            <tr>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ optional($transaction->user)->nama }}</td>
                <td>{{ $transaction->nama_pembeli }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ number_format($transaction->total_harga, 2, ',', '.') }}</td>
                <td>{{ number_format($transaction->bayar, 2, ',', '.') }}</td>
                <td>{{ number_format($transaction->kembalian, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">
        <h5>Daftar Pesanan</h5>
    </div>

    <table class="table table-light" id="table" aria-required="true">
        <thead>
            <tr>
                <th scope="col">Nomor Nota</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->no_nota }}</td>
                <td>{{ $order->good->nama }}</td>
                <td>{{ number_format($order->price, 2, ',', '.') }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ number_format($order->subtotal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas pembelian Anda!</p>
    </div>

</body>

</html>
