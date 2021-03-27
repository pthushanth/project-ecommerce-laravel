<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value == "noImage.jpg") {
            return '/storage/' . $value;
        }
        return '/storage/brand_images/' . $value;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
