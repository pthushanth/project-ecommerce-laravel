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
    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class);
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
