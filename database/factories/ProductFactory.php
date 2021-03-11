<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word;
        $slug = Str::slug($name, '-');

        return [
            // 'category_id' => Category::factory(),
            // 'brand_id' => Brand::factory(),
            'name' => $name,
            'slug' => $slug,
            'short_description' => $this->faker->text,
            'long_description' => $this->faker->text,
            'image' => ['noImage.jpg', 'noImage.jpg'],
            'status' => $this->faker->boolean,
            'price' => $this->faker->numberBetween($min = 100, $max = 1000)
        ];
    }
}
