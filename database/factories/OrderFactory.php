<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::factory(),
            // 'order_status_id' => OrderStatus::factory(),
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 2, $max = 2),
            'payment_id' => $this->faker->md5,
            'currency' => 'EUR',
            'payment_status' => $this->faker->randomElement($array = array('denied', 'accepted', 'pending')),
        ];
    }
}
