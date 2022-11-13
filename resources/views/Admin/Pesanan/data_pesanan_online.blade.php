<div class="tab-pane fade show active" id="pills-pesananOnline-icon" role="tabpanel" aria-labelledby="pills-pesananOnline-tab-icon">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pesananOnline" class="display table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Total Belanja</th>
                                <th>Biaya Ongkir</th>
                                <th>Status Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesananPelanggan as $pesanan)
                                <tr>
                                @if ($pesanan->metode_pembayaran == "TF")
                                    <td>{{$pesanan->id}}</td>
                                    <td>{{$pesanan->user->name}}</td>
                                    <td>{{$pesanan->alamat->alamat}}, {{$pesanan->alamat->kota->name}}, {{$pesanan->alamat->kode_pos}}, {{$pesanan->alamat->provinsi->name}}, {{$pesanan->negara}}</td>
                                    @php
                                        $total_bayar_produk = $pesanan->total_bayar - $pesanan->ongkos_kirim;
                                    @endphp
                                    <td>@currency($total_bayar_produk)</td>
                                    <td>@currency($pesanan->ongkos_kirim)</td>
                                    <td>{{$pesanan->status_pesanan}}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('AdminHalamanDetailPesananOnline', $pesanan->id) }}" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Detail Pesanan">
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
