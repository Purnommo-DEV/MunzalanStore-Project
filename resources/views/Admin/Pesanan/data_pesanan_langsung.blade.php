<div class="tab-pane fade" id="pills-pesananLangsung-icon" role="tabpanel" aria-labelledby="pills-pesananLangsung-tab-icon">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pesananLangsung" class="display table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Total Belanja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesananPelanggan as $pesanan)
                                <tr>
                                @if ($pesanan->metode_pembayaran == "Cash")
                                    <td>{{$pesanan->id}}</td>
                                        @php
                                            $total_bayar_produk = $pesanan->total_bayar - $pesanan->ongkos_kirim;
                                        @endphp
                                    <td>@currency($total_bayar_produk)</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('AdminHalamanDetailPesananLangsung', $pesanan->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Detail Pesanan">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
