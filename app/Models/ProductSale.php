<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    //Accessor
    public function getDiscountValueAttribute($value)
    {
        if ($this->is_percentage == true) return '-' . $value . '%';
        else return '-' . $value . ' €';
    }
    public function getDiscountedPrice($priceActual)
    {
        if ($this->is_percentage == true) {
            return (1 - ($this->getRawOriginal('discount_value') / 100)) * $priceActual . ' €';
        } else return $priceActual - $this->getRawOriginal('discount_value') . ' €';
    }

    //realtion
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
