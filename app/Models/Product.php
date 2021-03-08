<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    //json field as array
    protected $casts = [
        'spec' => 'array',
        'image' => 'array',
    ];

    protected $searchableColumns = ['name'];


    public function getAvgRating()
    {
        return $this->reviews->avg('rating');
    }

    public function currentUserCanReview()
    {
        // dd(!$this->currentUserHasSubmittedReview() && $this->currentUserHasPurchasedProduct());
        if (!$this->currentUserHasSubmittedReview() && $this->currentUserHasPurchasedProduct()) return true;
        return false;
    }
    public function currentUserHasSubmittedReview()
    {
        $countOfReviews = $this->reviews()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $this->id)
            ->get();
        return ($countOfReviews->isEmpty() ? false : true);
    }
    public function currentUserHasPurchasedProduct()
    {
        $countOfOrders = $this->orders()
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $this->id)
            ->get();

        return ($countOfOrders->isEmpty() ? false : true);
    }

    public function getThumbnailUrl()
    {
        $image = $this->image[0];
        if ($image === "noImage.jpg") return "storage/$image";
        else return "storage/product_images/$image";
    }
    public function getImageUrl($image)
    {
        if ($image === "noImage.jpg") return "storage/$image";
        else return "storage/product_images/$image";
    }

    // public function getImagesUrl()
    // {
    //     dd($this->image);
    //     if(count(array($this->image))>0){
    //       foreach ($this->image as $key=> $image) {
    //         if ($image === "noImage.jpg") $this->image[$key] ="storage/$image";
    //         else $this->image[$key]= "storage/product_images/$image";
    //         }  
    //     }

    //     return $this->image;

    // }

    // public function printEmptyStar()
    // {
    //     $html = '';
    //     for ($i = 0; $i < 5; $i++) {
    //         $html .= '<i class="far fa-star"></i>';
    //     }
    //     return $html;
    // }
    public function printAverageRatingStar()
    {
        $html = '';
        if ($this->reviews()->count() > 0) {
            $rating_sum = $this->getAvgRating();
            $average_stars = round($rating_sum * 2) / 2;
            $drawn = 5;
            for ($i = 0; $i < floor($average_stars); $i++) {
                $drawn--;
                $html .= ' <i class="fa fa-star"></i>';
            }

            if ($rating_sum - floor($average_stars) >= 0.5) {
                $drawn--;
                $html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
            }
            for ($drawn; $drawn > 0; $drawn--) {
                $html .= ' <i class="far fa-star"></i>';
            }
            return $html . "<span class='count-rating'> (" . $this->reviews()->count() . ")</span>";
        }

        $html = '';
        for ($i = 0; $i < 5; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }
        return $html;
    }
    //Accessor
    public function getThumbnailAttribute($value)
    {
        if ($value === "noImage.jpg") return "storage/$value";
        else return "storage/product_images/$value";
    }

    public function printPrice()
    {
        if ($this->productSale != null) {
            return '<p class="prix">' . $this->productSale->getDiscountedPrice($this->price) . ' <span> ' . $this->price . '</span></p>';
            return $this->productSale->getDiscountedPrice($this->price);
        } else return $this->price;
    }
    public function isOnSale()
    {
        if ($this->productSale == null) return false;
        return true;
    }

    // public function printProductCard()
    // {
    //     if ($this->productSale != null) {
    //         return '<p class="prix">' . $this->productSale->getDiscountedPrice($this->price) . ' <span> ' . $this->price . '</span></p>';
    //         return $this->productSale->getDiscountedPrice($this->price);
    //     } else return $this->price;
    // }
    /************************* Relationship *********************/
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

    public function productSale()
    {
        return $this->hasOne(ProductSale::class);
    }
}
