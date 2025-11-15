<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define relationship to order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // If you want the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
