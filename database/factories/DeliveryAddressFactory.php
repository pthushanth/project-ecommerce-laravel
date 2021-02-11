<?php

namespace Database\Factories;

use App\Models\DeliveryAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => "m",
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'address' => $this->faker->address,
            'city_id' => 1
        ];
    }
}
