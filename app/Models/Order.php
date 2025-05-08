<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'product_id', 'quantity', 'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
} 