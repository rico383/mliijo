<?php

namespace Database\Factories;

use App\Models\customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\message>
 */
class MessageFactory extends Factory
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
            'customer_id' => $cust->id,
                'name' => $this->faker->firstName(),
                'email' => $this->faker->email(),
                'number' => $this->faker->phoneNumber(),
                'message' => 'Hello',
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
