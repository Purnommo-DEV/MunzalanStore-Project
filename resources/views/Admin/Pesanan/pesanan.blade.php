@extends('Admin.Layouts.master')
@section('content')
	<div class="content">
		<div class="page-inner">
            <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-pesananOnline-icon" role="tab" aria-controls="pills-pesananOnline-icon" aria-selected="false">
                                            <i class="flaticon-list"></i>
                                            Pesanan Online
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-home-tab-icon" data-toggle="pill" href="#pills-pesananLangsung-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                            <i class="flaticon-interface-6"></i>
                                            Pesanan Langsung
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                                    @include('Admin.Pesanan.data_pesanan_langsung')
                                    @include('Admin.Pesanan.data_pesanan_online')
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection