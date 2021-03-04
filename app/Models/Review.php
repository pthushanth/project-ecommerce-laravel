<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function printRatingStar()
    {
        $html = '';
        $rating = $this->rating;
        $drawn = 5;
        for ($i = 0; $i < $rating; $i++) {
            $drawn--;
            $html .= ' <i class="fa fa-star"></i>';
        }
        for ($drawn; $drawn > 0; $drawn--) {
            $html .= ' <i class="far fa-star"></i>';
        }
        return $html;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
