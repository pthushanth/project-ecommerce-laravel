<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->numerify('PROMO#####'),
            'start' => $this->faker->dateTimeBetween('-5 days', '5 days'),
            'end' => $this->faker->dateTimeBetween('+5 days', '+15 days'),
            'discount_type' => $this->faker->randomElement($array = array('pourcentage', 'fixed')),
            'discount_value' => $this->faker->numberBetween($min = 10, $max = 70),
        ];
    }
}
