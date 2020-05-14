<?php

namespace App\Models;

use App\Http\Resources\cartItemsResource;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'cart_items', 'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cartItems()
    {
        if (is_null($this->cart_items)) {
            $this->cart_items = [];
            return $this->cart_items;
        }
        return $this->cart_items;
    }

    public function increseProductInCard(Product $product, $qty = 1)
    {
    $cartItems=$this->cartItems();
    foreach ($cartItems as $cartItem){
        if($cartItem->product->id===$product->id){
            $cartItem->qty=$qty;
        }
    }

    }

    public function addProductToCard(Product $product, $qty = 1)
    {
        $cartItems = $this->cartItems();
        /*
        *@var $cartItem cartItem
        */

        $cartItem = new cartItem($product, $qty);
        array_push($cartItems, $cartItem);
        $this->cart_item=json_incode($cartItems);

        $this->save();
        return $cartItems;
    }


    public function inItems($product_id)
    {
        $cartItems = $this->cartItems();

        foreach ($cartItems as $cartItem) {
            if ($product_id === $cartItem->product->id) {
                return true;
            }
        }
        return false;

    }

}
