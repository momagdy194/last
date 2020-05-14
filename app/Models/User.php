<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
        'email', 'email_verified',
        'mobile_verified', 'mobile',
        'password', 'shipping_address',
        'billing_address', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function shipments()
    {
        //collection return
        return $this->hasMany(Shipment::class);
    }

    public function shippingAddress()
    {
        //one obj return
        return $this->hasOne(Address::class, 'id', 'shipping_address');
    }

    public function billingAddress()
    {
        return $this->hasOne(Address::class, 'id', 'billing_address');
    }


    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function formattedName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }


}
