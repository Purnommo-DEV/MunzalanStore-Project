<?php

use App\Mail\NotifHapusProdukKeranjang;
use App\Models\Keranjang;
use App\Models\GambarProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

function totalBarangKeranjang(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalBarangKeranjang = Keranjang::where('user_id', $user_id)->count('kuantitas');
    }else{
        $session_id = Session::get('session_id');
        $totalBarangKeranjang = Keranjang::where('session_id', $session_id)->count('kuantitas');
    }
    return $totalBarangKeranjang;
}

function gambar_produk(){
    $gambar_produk = GambarProduk::get();
    return $gambar_produk;
}

function produk_dalam_keranjang(){
    $penggunaKeranjangItem = Keranjang::get();
    if($penggunaKeranjangItem == null){
    }
    else{
        foreach($penggunaKeranjangItem as $item){
            if ($item['expired'] < Carbon\Carbon::now()){
                return Keranjang::where('id', $item['id'])->delete();
            }
        }
    }
}

function penggunaKeranjangItem(){
    return Keranjang::penggunaKeranjangItem();
}