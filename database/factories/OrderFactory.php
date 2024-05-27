<?php

namespace Database\Factories;

use App\Models\customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cust=customer::all()->random();
        return [
            'customer_id' =>$cust->id,
            'name' => $this->faker->firstName(),
            'number' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'method' => 'BRI',
            'address' => $this->faker->address(),
            'total_products' => 1,
            'total_price' => 10000,
            'order_time' => now(),
            'event_time' => now(),
            'order_status' => null,
            'proof_payment' => $this->faker->image (public_path('bukti/'), width:50, height:50, category:null, fullPath:false),
            'payment_status' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
