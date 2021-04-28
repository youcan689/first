<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['cost', 'is_pay', 'pay_time'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
