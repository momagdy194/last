<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProductToCard(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required'

        ]);

        $user = Auth::user();
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        $product = Product::findorFail($product_id);

/*
*@var Cart
*/
        $cart = $user->cart;
        if(is_null($cart)){
            $cart=new Cart();
            $cart->cart_items = [];
            $cart->total = 0;

        }

        if ($cart->inItems($product_id)) {
            $cart->increseProductInCard($product, $qty);

        } else {

        $cart->addProductToCard($product, $qty);
        }


        return $cart;
        $cart->save();
        return new CartResource($cart);
    }

    private function checkCardStatues(Cart $cart = null)
    {
        if (is_null($cart)) {
            $cart = new Cart();
            $cart->cart_items = [];
            $cart->total = 0;
            $cart->user_id=Auth::user()->id;
            return $cart;
        }
            return $cart;

    }

}
