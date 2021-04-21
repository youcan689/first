<?php

namespace App\Http\Controllers;

use App\Production;

class ProductionController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function get()
    {
        return Production::all();
    }
}
