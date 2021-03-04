<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isDailyDeal()
    {
        return $this->name == "daily deal";
    }

    public static function getDailyDeals()
    {
        return self::with('products')->where('name', 'daily deal')->get();
    }
}
