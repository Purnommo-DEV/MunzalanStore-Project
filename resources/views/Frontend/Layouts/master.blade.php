<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title }}</title>	
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/images/favicon.ico')}}"> --}}
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/images/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/assets/images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend/assets/images/icons/favicon-16x16.png')}}"> --}}
    <link rel="manifest" href="{{asset('frontend/assets/images/icons/site.html')}}">
    <link rel="mask-icon" href="{{asset('frontend/assets/images/icons/safari-pinned-tab.svg" color="#666666')}}">
    {{-- <link rel="shortcut icon" href="{{asset('frontend/assets/images/icons/favicon.ico')}}"> --}}
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    {{-- <meta name="msapplication-config" content="{{asset('frontend/assets/images/icons/browserconfig.xml')}}"> --}}
    <meta name="theme-color" content="#ffffff">
    {{-- <link rel="stylesheet" href="{{asset('frontend/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/faktur.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/nouislider/nouislider.css')}}">
    
    <link rel="stylesheet" href="{{asset('frontend/assets/css/demos/demo-11.css')}}">
    
    {{-- <link rel="stylesheet" href="{{asset('frontend/assets/css/skins/skin-demo-13.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('frontend/assets/css/demos/demo-13.css')}}"> --}}

	{{-- TAMBAHAN --}}
	<link rel="stylesheet" href="{{asset('all/plugins/toastr/toastr.min.css')}}">
</head>
<body>
    @php
        produk_dalam_keranjang();
    @endphp
	<div class="page-wrapper">
        @include('sweetalert::alert')
        <header class="header header-7">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        <a href="{{ route('HalamanBeranda') }}" class="logo">
                            <img src="{{ asset('gambar/logo/Logo.png') }}" alt="MunzalanStore Logo" width="152" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container">
                                    <a href="{{ route('HalamanBelanja') }}">Produk</a>
                                </li>
                                <li class="megamenu-container">
                                    <a href="{{ route('FrontTentangKami') }}">Tentang Kami</a>
                                </li>
                            </ul>
                            <!-- End .menu -->
                        </nav>
                        <!-- End .main-nav -->
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                            <form action="{{ route('HalamanBelanja') }}" method="get" enctype="multipart/form-data">
                                <div class="header-search-wrapper">
                                    {{-- <label for="q" class="sr-only">Search</label> --}}
                                    <input name="name" type="text" class="form-control" placeholder="Cari Produk..">
                                </div>
                                <!-- End .header-search-wrapper -->
                            </form>
                        </div>
                        <!-- End .header-search -->

                            @if (Route::has('HalamanLogin'))
                            @auth
                            @if (Auth::user()->peran === "USER")
                            <a href="{{ route('HalamanProdukFavorit') }}" class="wishlist-link">
                                <i class="icon-heart-o"></i>
                                <span class="total-produkFavorit wishlist-count">0</span>
                            </a>
                            <div class="dropdown cart-dropdown">
                                <a href="#" class="dropdown-toggle" >
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count totalBarangKeranjang">{{ totalBarangKeranjang() }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <div class="dropdown-cart-products">
                                        @php
                                            $total_belanja = 0;
                                        @endphp
                                        @foreach (penggunaKeranjangItem() as $item)
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">{{$item->produk->name}} ({{$item->ukuran}})</a>
                                                </h4>
    
                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{$item->kuantitas}}</span>
                                                    x @currency($item->harga)
                                                </span>
                                                @if ($item['created_at'] < Carbon\Carbon::now()->subSecond(10))
                                                    <h4 class="product-title">
                                                        <a href="#" style="color: red">Produk ini telah lama di Keranjang anda</a>
                                                    </h4>
                                                @endif
                                            </div><!-- End .product-cart-details -->
    
                                            <figure class="product-image-container">
                                                <a href="#" class="product-image">
                                                    @foreach (gambar_produk() as $gambar_produks)
                                                    @if ($item['produk']['id'] == $gambar_produks->produk_id)
                                                    <img
                                                        src="{{ asset('gambar/gambar_produk') }}/{{ $gambar_produks->gambar1 }}">
                                                    @endif
                                                    @endforeach
                                                </a>
                                            </figure>
                                        </div><!-- End .product -->
                                        @php
                                            $total_belanja += $item->kuantitas * $item->harga
                                        @endphp
                                        @endforeach
                                        <!-- End .product -->
                                    </div>
                                    <!-- End .cart-product -->

                                    <!-- End .dropdown-cart-total -->
                                    <div class="dropdown-cart-total">
                                        <span>Total</span>
                                        <span class="cart-total-price">@currency($total_belanja)</span>
                                    </div><!-- End .dropdown-cart-total -->
    
                                    <div class="dropdown-cart-action">
                                        <a href="{{route('HalamanKeranjang')}}" class="btn btn-block btn-outline-primary-2"><span>Periksa</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                    <!-- End .dropdown-cart-total -->
                                </div>
                                
                            </div>

                            <div class="dropdown cart-dropdown">
                            @php
                                $hitung_pesanan_dikirim = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('resi','>','0')->where('status_pesanan', '=', 'Dikirim')->count();
                                $status_pesanan = \App\Models\Pesanan::where('user_id', Auth::user()->id)
                                    ->where('resi','>','0')
                                    ->where('status_pesanan', '=', 'Dikirim')->paginate(4);
                            @endphp
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-info-circle"></i>
                                    <span class="cart-count">{{ $hitung_pesanan_dikirim }}</span>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <div class="dropdown-cart-products">
                                        @foreach ($status_pesanan as $status_dikirim)
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="product.html">Pesanan Anda Sedang Dikirim</a>
                                                </h4>
    
                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $status_dikirim->created_at->diffForHumans() }}<br>({{ $status_dikirim->created_at->toFormattedDateString()}})</span>
                                                </span>
                                            </div>
                                            <!-- End .product-cart-details -->
    
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <i class="fa fa-car"></i>
                                                </a>
                                            </figure>
                                        </div>
                                        @endforeach
                                        <!-- End .product -->
                                    </div>
                                    <!-- End .cart-product -->

                                    <!-- End .dropdown-cart-total -->
    
                                    <div class="dropdown-cart-action">
                                        <a href="{{route('HalamanProfile')}}" class="btn btn-block btn-outline-primary-2"><span>Selengkapnya</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                    <!-- End .dropdown-cart-total -->
                                </div>
                                <!-- End .dropdown-menu -->
                            </div>
                            <ul class="menu sf-arrows">
                            <li>
                                <a href="#" class="wishlist-link">
                                    <i class="icon-user"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a title="Profile" href="{{route('HalamanProfile')}}" class="sf-with-ul">Profile</a>
                                    </li>
                                    <li>
                                        <a title="Keluar" href="{{route('UserLogOut')}}" 
                                        onclick="event.preventDefault(); 
                                        document.getElementById('logout-form').submit();">Keluar</a>
                                    </li>
                                    <form id="logout-form" action="{{route('UserLogOut')}}" method="post">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        </ul>
                        @else
                        <a href="{{route('HalamanLogin')}}" class="wishlist-link">
                            <span class="cart-txt">Login</span>
                        </a>
                        <a href="{{route('HalamanRegister')}}" class="wishlist-link">
                            <span class="cart-txt">Register</span>
                        </a>
                        @endif
                        @else
                            <a href="{{route('HalamanLogin')}}" class="wishlist-link">
                                <span class="cart-txt">Login</span>
                            </a>
                            <a href="{{route('HalamanRegister')}}" class="wishlist-link">
                                <span class="cart-txt">Register</span>
                            </a>
                        @endif
                        @endif
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-middle -->
        </header>
        <!-- End .header -->
        {{-- main --}}
        <main class="main">
            @yield('konten')
        </main>
        <!-- End .main -->

        <footer class="footer">

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright" style="font-size: 8px;">Copyright © 2022 Template By MollaStore</p>
                    <!-- End .footer-copyright -->
                    <figure class="footer-payments">
                        <img src="{{ asset('gambar/logo/Logo.png') }}" alt="Munzalan Store" width="150" height="20">
                    </figure>
                    <!-- End .footer-payments -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-bottom -->
        </footer>

    </div>
    <!-- End .page-wrapper -->
        <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="{{ route('HalamanBelanja') }}" method="get" enctype="multipart/form-data" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input name="name" type="text" class="form-control" id="mobile-search" placeholder="Cari Produk..">
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    @if (Auth::user() == NULL)
                    <li>
                        <a href="{{ route('HalamanBelanja') }}">Produk</a>
                    </li>
                    <li>
                        <a href="{{route('HalamanLogin')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{route('HalamanRegister')}}">Register</a>
                    </li>
                    <li>
                        <a href="{{ route('FrontTentangKami') }}">Tentang Kami</a>
                    </li>
                    @elseif (Auth::user()->peran == "USER")
                    <li>
                        <a href="#" class="sf-with-ul" style="font-size: 20px;">
                            <i class="icon-user"></i>
                            {{(Auth::user()->name)}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('HalamanProdukFavorit') }}">Produk Favorit <span class="total-produkFavorit wishlist-count">0</span></a>
                    </li>
                    <li>
                        <a href="{{ route('HalamanKeranjang') }}">Keranjang <span class="cart-count totalBarangKeranjangClass index">{{ totalBarangKeranjang() }}</span></a>
                    </li>
                    <li>
                        <a title="Profile" href="{{route('HalamanProfile')}}" class="sf-with-ul">Profile</a>
                    </li>
                    <li>
                        <a title="Keluar" href="{{route('UserLogOut')}}" 
                        onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">Keluar</a>
                    </li>
                        <form id="logout-form" action="{{route('UserLogOut')}}" method="post">
                            @csrf
                        </form>
                    @endif

                    {{-- @if (Route::has('HalamanLogin'))
                    
                    @elseif (Auth::user()->peran == "USER")
                    <li class="active">
                        <a href="{{ route('HalamanProdukFavorit') }}">Produk Favorit</a>
                        <ul>
                            <li><a href="index-1.html">01 - furniture store</a></li>
                        </ul>
                    </li>
                    @elseif (Auth::user()->peran ==="")
                    <li class="active">
                        <a href="{{route('HalamanLogin')}}">Login</a>
                    </li>
                    <li class="active">
                        <a href="{{route('HalamanRegister')}}">Register</a>
                    </li>
                    @else
                    <li class="active">
                        <a href="{{route('HalamanLogin')}}">Login</a>
                    </li>
                    <li class="active">
                        <a href="{{route('HalamanRegister')}}">Register</a>
                    </li>
                    @endif --}}
                </ul>
            </nav>

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div>
            <!-- End .social-icons -->
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                    <!-- .End .input-group-append -->
                                </div>
                                <!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                            <!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/superfish.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wNumb.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.elevateZoom.min.js')}}"></script>

    {{-- SEMENTARA DIAKTIFKATAN --}}
    {{-- JIKA DI AKTIFKAN MAKA TIDAK BISA UPDATE KUANTITAS PRODUK DI KERANJANG --}}
    <script src="{{asset('frontend/assets/js/nouislider.min.js')}}"></script>
    {{-- ------------------------------- --}}
    
    <script src="{{asset('frontend/assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('frontend/assets/js/demos/demo-11.js')}}"></script>
    <script src="{{asset('frontend/assets/js/functions.js')}}"></script>
	@yield('script')

	{{-- TAMBAHAN --}}
		<!-- Sweet Alert -->
	<script src="{{asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
	<script src="{{asset('all/plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   

    <script>
        @if (Session::has('message')) {

            var type = "{{  Session::get('alert-type','info') }}"
            switch (type) {

                case 'info':
                    toastr.info("{{ Session::get('message') }}")
                    break;
            }            
        }
        @endif
    </script>

    <script>
        tampilProdukFavorit();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
        
            function tampilProdukFavorit() {
                $.ajax({
                    method: "GET",
                    url: "/totalProdukFavorit",
                    success: function (response) {
                        $('.total-produkFavorit').html('');
                        $('.total-produkFavorit').html(response.totalProdukFavorit);
                    }
                });
            }
        
            $(document).ready(function () {
                $(".tambahKeFaforitBtn").click(function (e) {
                    e.preventDefault();
                    var produk_id = $(this)
                        .closest(".produk-data")
                        .find(".produk_id")
                        .val();
                    $.ajax({
                        method: "POST",
                        url: "/tambahKeProdukFavorit",
                        data: {
                            produk_id: produk_id
                        },
                        success: function (response) {
                            alert(response.status);
                            tampilProdukFavorit();
                        }
                    });
                });
            });
    </script>
    <script>
        $(document).ready(function(){
            //active select2
            // $(".provinsi, .kota").select2({
            //     theme:'bootstrap4',dropdownCssClass: "bigdrop",
            // });
            //ajax select kota asal
            $('select[name="provinsi_id"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/kota/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="kota_id"]').empty();
                            $('select[name="kota_id"]').append('<option value="">-- Pilih Kota --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="kota_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="kota_id"]').append('<option value="">-- Pilih Kota --</option>');
                }
            });
        });
    </script>
</body>
</html>