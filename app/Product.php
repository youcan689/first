<?php

namespace App;

use App\Order;
use App\ProductImage;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'title', 'description', 'price', 'published',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
