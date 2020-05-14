<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable  = ['user_id' , 'wish_list'];


    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
