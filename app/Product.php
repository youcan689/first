<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
