<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Attribute;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // \App\Models\User::factory(10)->create();
    //     $this->call(UserSeeder::class);

    //     // User::factory(10)->create();
    //     // OrderStatus::factory(3)->create();
    //     // Category::factory(20)->create();
    //     // Brand::factory(10)->create();
    //     Attribute::factory(30)->create();

    //     $products = Product::factory(50)
    //         ->has(Stock::factory())
    //         ->hasAttached(
    //             Attribute::factory()->count(5),
    //             ['value' => "test"]
    //         )
    //         ->create();

    //     Order::factory(50)
    //         ->hasAttached(
    //             Coupon::factory()->count(5)
    //         )
    //         ->hasAttached(
    //             Product::factory()->for(Category::factory())
    //                 ->hasAttached(
    //                     Attribute::factory()->count(5),
    //                     ['value' => "test"]
    //                 )->count(2),
    //             ['qty' => rand(1, 5)]
    //         )
    //         ->create();
    // }

    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);

        $products = Product::factory(50)
            ->for(Category::factory())
            ->for(Brand::factory())
            ->has(Stock::factory())
            ->hasAttached(
                Attribute::factory()->count(5),
                ['value' => "test"]
            )
            ->create();

        $users = User::factory(10)->create();

        OrderStatus::factory(3)->create();
        Category::factory(20)->create();
        Brand::factory(10)->create();
        Attribute::factory(30)->create();

        // Rating::factory(30)
        //     ->for($this->randomArrayElement($products))
        //     ->for($this->randomArrayElement($users))
        //     ->create();
        // for ($i = 0; $i < 30; $i++) {
        //     Rating::factory()
        //         ->for($this->randomArrayElement($products))
        //         ->for($this->randomArrayElement($users))
        //         ->create();
        // }

        for ($i = 0; $i < 30; $i++) {
            Review::factory()
                ->for($this->randomArrayElement($products))
                ->for($this->randomArrayElement($users))
                ->create();
        }


        Order::factory(50)
            ->for($users[1])
            ->for(DeliveryAddress::factory()->for($users[1]))
            ->for(OrderStatus::factory())
            ->hasAttached(
                Coupon::factory()->count(5)
            )
            ->hasAttached(
                Product::factory()->for(Category::factory())
                    ->for(Brand::factory())
                    ->has(Stock::factory())
                    ->hasAttached(
                        Attribute::factory()->count(5),
                        ['value' => "test"]
                    )->count(2),
                ['qty' => rand(1, 5)]
            )
            ->create();
    }

    private function randomArrayElement($array)
    {
        $array = iterator_to_array($array);
        shuffle($array);
        return $array[0];
    }
}
