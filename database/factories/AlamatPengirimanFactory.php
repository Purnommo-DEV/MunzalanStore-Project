<?php

namespace Database\Factories;

use App\Models\AlamatPengiriman;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlamatPengirimanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = AlamatPengiriman::class;

    public function definition()
    {
        return [
            'invoice' => $this->faker->unique()->numberBetween(1,20),  
            'user_id',
            'subtotal',
            'no_resi',
            'status_order_id',
            'metode_pembayaran',
            'ongkir',
            'created_at' ,
            'updated_at' ,
            'biaya_cod' ,
            'no_hp' ,
            'bukti_pembayaran',
            'pesan'
        ];
    }
}
