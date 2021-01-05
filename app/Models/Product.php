<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //json field as array
    protected $casts = [
        'spec' => 'array',
        'image' => 'array',
    ];




    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function dailyDeal()
    {
        return $this->hasOne(DailyDeal::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
