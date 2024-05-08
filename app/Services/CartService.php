<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService  {
    public function add($sku, $quantity) {
        if (!Session::has('cart')) {
            Session::put('cart', collect());
        }

        $cart = Session::get('cart');

        if ($cart->has($sku)) {
            $cart->put($sku, $cart->get($sku, 0) + $quantity);
        } else {
            $cart->put($sku, $quantity);
        }
        Session::put('cart', $cart);

        return true;
    }

    public function remove($sku) {
        $cart = Session::get('cart');
        $cart->forget($sku);
        Session::put('cart', $cart);
    }

    public function list() {
        return Session::get('cart', collect())->all();
    }
}

