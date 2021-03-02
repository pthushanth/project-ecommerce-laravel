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

    protected $searchableColumns = ['name'];


    function getAvgRating()
    {
        return $this->reviews->avg('rating');
    }

    //Accessor
    public function getThumbnailAttribute($value)
    {
        if ($value === "noImage.jpg") return "storage/$value";
        else return "storage/product_images/$value";
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('value');
    }

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
