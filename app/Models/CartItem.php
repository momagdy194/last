<?php

namespace App\Models;



class CartItem
{

    public  $product;

    public  $qty;

    /**
     * CartItem constructor.
     * @param $product
     * @param $qty
     */
    public function __construct($product, $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

}
