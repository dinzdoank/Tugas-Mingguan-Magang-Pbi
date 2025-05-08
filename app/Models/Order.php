<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'address', 'product_id', 'quantity', 'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notify()
    {
        if ($this->user) {
            $this->user->notify(new OrderApproved($this));
        }
    }
} 