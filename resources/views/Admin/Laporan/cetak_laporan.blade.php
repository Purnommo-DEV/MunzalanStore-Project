
<!DOCTYPE html>
<html lang="en">
<head>
    <title>LP-{{ $tanggal_awal }} - {{ $tanggal_akhir }}</title>
    <link rel="stylesheet" href="{{asset('frontend/assets/css/faktur.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="toolbar hidden-print">
                    <div class="text-end">
                        <button type="button" onClick="window.print()" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                    </div>
                    <hr>
                </div>
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a href="javascript:;">
    												<img src="assets/images/logo-icon.png" width="80" alt="">
												</a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="javascript:;">
									Laporan Penjualan
									</a>
                                    </h2>
                                    <div>Laporan : {{ Carbon\Carbon::parse($tanggal_awal)->isoFormat('dddd, D MMMM Y') }} s/d {{ Carbon\Carbon::parse($tanggal_akhir)->isoFormat('dddd, D MMMM Y') }}</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <table class="table align-middle mb-0 bg-white">
                                <thead class="bg-light">
                                    <tr style="font-weight: bold;">
                                        <th>Tanggal</th>
                                        <th>Kode Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga Satuan</th>
                                        <th>Status</th>
                                        <th>Total</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_keseluruhan = 0;
                                    @endphp
                                    @foreach ($data_pesanan as $data_pesanans)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($data_pesanans->created_at)->isoFormat('dddd, D MMMM Y, h:mm A') }}</td>
                                            <td>{{ $data_pesanans->id }}</td>
                                            <td>{{ $data_pesanans->user->name }}</td>
                                            <td colspan="1">
                                            @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                <hr>{{ $data_pesanan_produks->nama_produk }} ({{ $data_pesanan_produks->ukuran_produk }})<hr>
                                                @endif
                                            @endforeach
                                            </td>
                                            <td colspan="1">
                                                @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                    @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                    <hr>{{ $data_pesanan_produks->kuantitas }}<hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td colspan="1">
                                                @foreach ($data_pesanan_produk as $data_pesanan_produks)
                                                @php
                                                    $sub_total = $data_pesanan_produks->harga_produk * $data_pesanan_produks->kuantitas;
                                                    $total_keseluruhan += $data_pesanan_produks->harga_produk * $data_pesanan_produks->kuantitas;
                                                @endphp
                                                    @if ($data_pesanans->id == $data_pesanan_produks->pesanan_id)
                                                    <hr>@currency($data_pesanan_produks->harga_produk)<hr>
                                                    @endif
                                                @endforeach
                                                
                                            </td>
                                             <td colspan="1">
                                                <span class="badge badge-primary rounded-pill d-inline">{{ $data_pesanans->status_pesanan }}</span>
                                            </td>
                                            <td colspan="1">
                                                    @currency($data_pesanans->total_bayar)
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="notices">
                                <div>TOTAL PENDAPATAN</div>
                                <div class="notice">@currency($total_pendapatan_seluruhnye)</div>
                            </div>
                        </main>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>