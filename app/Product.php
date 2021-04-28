<?php

namespace App;

use App\Order;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
