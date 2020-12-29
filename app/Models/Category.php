<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
