<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    //accesssor
    public function getImageAttribute($value)
    {
        if ($value == "noImage.jpg") {
            return '/storage/' . $value;
        }
        return '/storage/category_images/' . $value;
    }

    public function relatedProducts()
    {
        return $this->products()->inRandomOrder()->take(4);
    }

    /******  Relationship  *****/
    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }
}
