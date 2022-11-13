<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifHapusProdukKeranjang extends Mailable
{
    use Queueable, SerializesModels;
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
    public function build()
    {
        // return $this->view('view.name');
        $from_name = "MunzalanStore";
        $from_email = "munzalanstore@gmail.com";
        $subject = "Produk dihapus dari Keranjang";
        return $this->from($from_email, $from_name)
            ->view('Frontend.Mails.hapus_data_keranjang')
            ->subject($subject);
    }
}
