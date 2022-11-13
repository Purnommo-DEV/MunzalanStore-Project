@extends('Admin.Layouts.master')
@section('content')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                        <h4 class="card-title">Produk Pesanan</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="produk_pesanan" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Kuantitas</th>
                                                    <th>Harga Produk</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produkDiPesan as $produkDiPesans)
                                                <tr>
                                                    <td>{{$produkDiPesans->nama_produk}}</td>
                                                    <td>{{$produkDiPesans->kuantitas}}</td>
                                                    <td>@currency($produkDiPesans->harga_produk)</td>
                                                    @php
                                                    $sub_total = $produkDiPesans->harga_produk *
                                                    $produkDiPesans->kuantitas
                                                    @endphp
                                                    <td>@currency($sub_total)</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-6 col-md-12">
                            <div class="card-header" style="padding: 0.1rem 1.0rem;">
                                <h4 class="card-title" style="font-size: 14px;">Ringkasan</h4>
                            </div>
                            <div class="card card-pricing">
                                <ul class="specification-list">
                                    @php
                                    $sub_total_pesanan = $pesananPelanggan->total_bayar -
                                    $pesananPelanggan->ongkos_kirim;
                                    @endphp
                                    <li>
                                        <span class="name-specification">Sub Total Pesanan</span>
                                        <span class="status-specification">@currency($sub_total_pesanan)</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Total</span>
                                        <span
                                            class="status-specification">@currency($pesananPelanggan->total_bayar)</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Status Pesanan</span>
                                        <span class="status-specification" style="color: rgb(0, 145, 255)">
                                            {{ $pesananPelanggan->status_pesanan }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Metode Pembayaran</span>
                                        <span class="status-specification">
                                            {{ $pesananPelanggan->metode_pembayaran }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection