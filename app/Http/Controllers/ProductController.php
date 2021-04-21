<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function get()
    {
        return Product::all();
    }
}
