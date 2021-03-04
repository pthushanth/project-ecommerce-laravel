<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getClients()
    {
        return User::where('role', 'client')->get();
    }
    public static function getClient()
    {
        return User::with('customer')->where('role', 'client')->where('id', Auth::user()->id)->first();
    }

    public static function getAdmin()
    {
        return User::where('role', 'admin')->get();
    }

    public function isAdmin()
    {
        return $this->role == "admin";
    }
    public function isClient()
    {
        return $this->role == "client";
    }
    public function getAvatarUrl()
    {
        $avatar = $this->avatar;
        return "storage/avatars/" . $avatar;
    }
    /********************        RelationShip       *******************/
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function deliveryAdresses()
    {
        return $this->hasMany(DeliveryAddress::class);
    }
}
