<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;

class ConsumerController extends Controller
{
    public function showProducts()
    {
        return view('consumer.products');
    }

    public function getProducts()
    {
        $products = Product::where('published', '=', 1)->get();
        return ['products' => $products];
    }

    public function addCart()
    {
        $orderNotPays = auth()->user()->orders()->where('is_pay', false)->get();
        if ($orderNotPays->isNotEmpty()) {
            $cart = $orderNotPays->first();
        } else {
            $cart = new Order(['cost' => 0, 'is_pay' => false]);
            $cart->user()->associate(auth()->user());
            $cart->save();
        }
        $cart->products()->attach(request('productId'));
        $product = Product::find(request('productId'));
        $cart->cost = ($cart->cost) + ($product->price);
        $cart->save();
        $cart->loadMissing('products');
        return ['cart' => $cart];
    }

    public function getCart()
    {
        if (!auth()->check()) {
            return ['cartEnd' => null];
        }
        $cart = auth()->user()->orders()->where('is_pay', false)->get()->first();
        $cart->loadMissing('products');
        return ['cartEnd' => $cart];
    }
}
