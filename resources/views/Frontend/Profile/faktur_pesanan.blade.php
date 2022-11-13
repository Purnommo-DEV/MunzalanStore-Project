<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faktur-{{ $pesananPelanggan->id }}</title>
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
									MunzalanStore
									</a>
                                    </h2>
                                    <div>Jl. Sungai Raya Dalam Samping Roti Gembul</div>
                                    <div>0895704043675</div>
                                    <div>munzalanstore2@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">Faktur Untuk:</div>
                                    <h2 class="to">{{ Auth::user()->name }}</h2>
                                    <div class="address">{{ $pesananPelanggan->alamat->alamat }}, {{ $pesananPelanggan->alamat->kota->name }}, {{ $pesananPelanggan->alamat->provinsi->name }}</div>
                                    <div class="email"><a href="mailto:john@example.com">{{ Auth::user()->email}}</a>
                                    </div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Faktur-{{ $pesananPelanggan->id}}</h1>
                                    <div class="date">Tanggal Faktur: {{ $pesananPelanggan->created_at->toFormattedDateString() }}</div>
                                    {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th class="text-left">Produk</th>
                                        <th class="text-right">Harga Satuan</th>
                                        <th class="text-right">Kuantitas</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sub_total = 0;
                                        $total_keseluruhan = 0 + $pesananPelanggan->ongkos_kirim;
                                    @endphp
                                    @foreach($produkDiPesan as $produkDiPesans)
                                    @if($produkDiPesans->pesanan_id == $pesananPelanggan->id)
                                    <tr>
                                        <td class="no">{{$produkDiPesans->produk->id}}</td>
                                        <td class="text-left">
                                            <h3>
                                                <a target="_blank" href="javascript:;">
                                                {{$produkDiPesans->produk->name}}
										</a>
                                            </h3>
                                        <a target="_blank" href="javascript:;">
										   Ukuran : {{ $produkDiPesans->ukuran_produk }}
									   </a> {{$produkDiPesans->produk->deskripsi_singkat}}</td>
                                        <td class="unit">@currency($produkDiPesans->produk->harga)</td>
                                        <td class="qty">{{ $produkDiPesans->kuantitas }}</td>
                                        @php
                                        $total = $produkDiPesans->harga_produk * $produkDiPesans->kuantitas;
                                        $sub_total += $produkDiPesans->harga_produk * $produkDiPesans->kuantitas;
                                        $total_keseluruhan += $produkDiPesans->harga_produk * $produkDiPesans->kuantitas
                                        @endphp
                                        <td class="total">@currency($total)</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>@currency($sub_total)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Ongkos Kirim</td>
                                        <td>@currency($pesananPelanggan->ongkos_kirim)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TOTAL</td>
                                        <td>@currency($total_keseluruhan)</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Terima Kasih, {{ Auth::user()->name }}</div>
                            {{-- <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div> --}}
                        </main>
                        <footer>MunzalanStore, Dakwah With Your Attitude</footer>
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