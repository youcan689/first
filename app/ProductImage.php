<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    
    protected $fillable = ['url'];

    public const location = '/products/';
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
