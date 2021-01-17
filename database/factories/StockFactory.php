<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'product_id' => Product::factory(),
            'stock' => $this->faker->numberBetween($min = 20, $max = 100),
            'low_stock_amount' => $this->faker->numberBetween($min = 5, $max = 10),
        ];
    }
}
