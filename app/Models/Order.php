<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
    ];
    
    

    // Relationship to order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
