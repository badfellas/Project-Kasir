<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* Mengatur margin dan padding halaman untuk PDF */
        @page {
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        /* Mengatur tabel agar lebih rapi */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Penataan untuk header */
        h5 {
            margin-bottom: 5px;
            font-size: 18px;
        }

        h6 {
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Menyembunyikan elemen-elemen yang tidak perlu untuk cetakan */
        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
                font-size: 12px;
            }

            table th, table td {
                padding: 10px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }
        }

        /* Menambahkan ruang di footer */
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <center>
        <h5>Laporan Barang</h5>
        <h6>Toko</h6>
    </center>

    <table class="table table-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $a = 1; ?>
            @foreach ($goods as $good)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $good->tgl_masuk }}</td>
                    <td>{{ $good->nama }}</td>
                    <td>{{ $good->category->nama }}</td>
                    <td>{{ $good->stok }}</td>
                    <td>{{ number_format($good->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas perhatian Anda!</p>
    </div>

</body>

</html>
