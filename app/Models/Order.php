<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_status()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
