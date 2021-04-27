<?php

namespace App\Http\Controllers;

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
}
