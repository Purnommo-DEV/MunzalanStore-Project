<html>
<head>
    <style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <p>Mohon Maaf, kami menghapus produk dari keranjang anda, karena produk terlalu lama di keranjang belanja anda</p>
            <p>Note : Produk akan bertahan selama 3 hari dalam keranjang anda</p>
        </div>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td style="color: black; background-color: #ffffff">{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td style="color: black; background-color: #ffffff">{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Hp</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['nomor_hp'] }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['alamat'] }}</td>
                </tr>
                <tr>
                    <th>Kota</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['kota']['name'] }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td style="color: black; background-color: #ffffff">{{ $alamat_pengiriman['provinsi']['name'] }}</td>
                </tr>
            </thead>
        </table>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Ukuran</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_bayar = 0;        
                @endphp
                @foreach ($data_produk_dipesan as $items)
                <tr>
                    <td>{{ $items['nama_produk'] }}</td>
                    <td>{{ $items['ukuran_produk'] }}</td>
                    <td>{{ $items['kuantitas'] }}</td>
                    <td>@currency($items['harga_produk'])</td>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
